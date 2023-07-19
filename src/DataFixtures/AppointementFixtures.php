<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppointementFixtures extends Fixture
{
    public const APPOINTEMENTS = [
        ['name' => 'BANDES-ANNONCES', 'file' => 'gaming_house.jpg'],
        ['name' => 'DOCUMENTAIRES', 'file' => 'docu-categories.jpg'],
        ['name' => 'NOUVEAUTES', 'file' => 'new-categories.jpg'],
        ['name' => 'ESPORT', 'file' => 'esport-categories.jpg']
    ];

    public function load(ObjectManager $manager): void
    {
        $manager->flush();
    }
}
