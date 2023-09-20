<?php

namespace App\Tests\Repository;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CompanyTypeTest extends KernelTestCase
{

    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

    }
    
    public function testGetCompanyCount(): void
    {
        $erTypeCount = $this->getContainer()->get(CompanyRepository::class)->count([]);
        $this->assertGreaterThan(0, $erTypeCount, 'Incorrect erTypeCount count');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
