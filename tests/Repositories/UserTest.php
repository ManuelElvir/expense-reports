<?php

namespace App\Tests\Repository;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class UserRepositoryTest extends KernelTestCase
{

    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

    }
    
    public function testGetUserCount(): void
    {
        $userCount = $this->getContainer()->get(UserRepository::class)->count([]);
        $this->assertGreaterThan(0, $userCount, 'Incorrect user count');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
