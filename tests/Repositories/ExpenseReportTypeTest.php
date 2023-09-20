<?php

namespace App\Tests\Repository;

use App\Repository\ExpenseReportTypeRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class ExpenseReportTypeTest extends KernelTestCase
{

    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

    }
    
    public function testGetExpenseReportTypeCount(): void
    {
        $erTypeCount = $this->getContainer()->get(ExpenseReportTypeRepository::class)->count([]);
        $this->assertGreaterThan(0, $erTypeCount, 'Incorrect erTypeCount count');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
