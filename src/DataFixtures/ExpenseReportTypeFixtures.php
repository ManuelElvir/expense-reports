<?php

namespace App\DataFixtures;

use App\Entity\ExpenseReportType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpenseReportTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Add user 
        $types = ['Essence', 'Péage', 'Repas', 'Conférence'];

        foreach ($types as $type) {

            $erType = (new ExpenseReportType())->setName($type);
            $manager->persist($erType);

        }

        $manager->flush();
    }
}
