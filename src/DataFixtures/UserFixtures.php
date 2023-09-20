<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{


    public function load(ObjectManager $manager): void
    {

        // Add user 
        $user = new User();
        $user->setEmail('user1@example.com');
        $user->setPassword('$2y$10$EciprovBg2xFfP6XQtFaje039KxqvkqSFAiZhxrtk6tFkk9QId6US');
        $user->setFirstName('User1');
        $user->setLastName('Test');

        $manager->persist($user);

        $manager->flush();
    }
}
