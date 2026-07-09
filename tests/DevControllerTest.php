<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

final class DevControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', '/demo');
        self::assertResponseIsSuccessful();
        //self::assertPageTitleContains('Jardins de Cocagne');
        //self::assertSame('Ensemble, cultivons la solidarité', $crawler->filter('h1')->first()->text());
    }
}
