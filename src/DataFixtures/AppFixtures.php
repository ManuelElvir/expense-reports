<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\ExpenseReport;
use App\Entity\ExpenseReportType;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Add user 
        $user = new User();
        $user->setEmail('user'.rand(10, 999).'@example.com');
        $user->setPassword('$2y$10$EciprovBg2xFfP6XQtFaje039KxqvkqSFAiZhxrtk6tFkk9QId6US');
        $user->setFirstName('User1');
        $user->setLastName('Test');
        $manager->persist($user);

        // Add expense report types
        $types = ['Essence', 'Péage', 'Repas', 'Conférence'];
        $erTypes = [];

        foreach ($types as $type) {

            $erType = (new ExpenseReportType())->setName($type);
            array_push($erTypes, $erType);
            $manager->persist($erType);

        }

        // Add companies
        $companies = ['Kiss The Bride', 'Loyalty '];

        /**
         * var Company[]
         */
        $companiesE = [];
        foreach ($companies as $company) {

            $companyE = (new Company())->setName($company);
            array_push($companiesE, $companyE);
            $manager->persist($companyE);

        }


        // Add expenses reports
        for($i = 0; $i < 5; $i++) {

            $expenseReport = (new ExpenseReport())
                ->setReportDate(new \DateTime)
                ->setAmount(rand(40, 120))
                ->setReportType($erTypes[rand(0, 3)])
                ->setCompany($companiesE[rand(0, 1)])
                ->setOwner($user);
            $manager->persist($expenseReport);
        }

        $manager->flush();
    }
}
