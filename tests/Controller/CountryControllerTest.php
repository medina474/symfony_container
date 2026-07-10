<?php

namespace App\Tests\Controller;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Loader\SymfonyFixturesLoader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CountryControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;

    /** @var EntityRepository<Country> */
    private EntityRepository $countryRepository;
    private string $path = '/country/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();

        $loader = static::getContainer()->get('doctrine.fixtures.loader');

        $purger = new ORMPurger($this->manager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);

        $executor = new ORMExecutor($this->manager, $purger);
        $executor->execute($loader->getFixtures());

        $this->countryRepository = $this->manager->getRepository(Country::class);

        // Auth
        /*
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneBy(['email' => 'compta@jdc-thaon.fr']);
        $this->client->loginUser($user, 'main');
        */
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseIsSuccessful();
        self::assertPageTitleContains('Pays');
        self::assertSame('FR', $crawler->filter('td')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'country[code]' => 'DE',
            'country[country]' => 'Allemagne',
            'country[long]' => 'République fédérale d\'Allemagne',
            'country[flag]' => '🇫🇷',
        ]);

        self::assertResponseRedirects('/admin/country');

        self::assertSame(2, $this->countryRepository->count([]));
    }

    public function testShow(): void
    {
        $this->client->request('GET', sprintf('%s%s', $this->path, 'FR'));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('France');
    }

    public function testEdit(): void
    {
        $this->client->request('GET', sprintf('%s%s/edit', $this->path, 'FR'));

        $this->client->submitForm('Update', [
            'country[code]' => 'Something New',
            'country[country]' => 'Something New',
            'country[long]' => 'Something New',
            'country[flag]' => 'Something New',
            'country[tncc]' => '1',
        ]);

        self::assertResponseRedirects('/country');

        $fixture = $this->countryRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getCode());
        self::assertSame('Something New', $fixture[0]->getCountry());
        self::assertSame('Something New', $fixture[0]->getLong());
        self::assertSame('Something New', $fixture[0]->getFlag());
        self::assertSame('Something New', $fixture[0]->getTncc());
    }

    public function testRemove(): void
    {
        $this->client->request('GET', sprintf('%s%s', $this->path, 'FR'));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/country');
        self::assertSame(0, $this->countryRepository->count([]));
    }
}
