<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Country;
use App\Entity\Tncc;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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
        //$country->setTncc($tncc);
        $manager->persist($country);

        $manager->flush();

        $manager->flush();
    }
}
