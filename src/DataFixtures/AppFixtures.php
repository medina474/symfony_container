<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\Tncc;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        // php bin/console doctrine:fixtures:load --env=test

        $user = new User();
        $user->setEmail('admin@app.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->hasher->hashPassword($user, 'password'));
        $manager->persist($user);

        $tncc = new Tncc();
        $tncc->setId(1);
        $tncc->setArticle("la ");
        $tncc->setCharniere("de la ");
        $manager->persist($tncc);

        $country = new Country();
        $country->setCode('FR');
        $country->setCountry('France');
        $country->setLong('République française');
        $country->setFlag('🇫🇷');
        $country->setTncc($tncc);
        $manager->persist($country);

        $manager->flush();
    }
}
