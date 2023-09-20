<?php

namespace App\Tests\Entity;

use App\Entity\Company;
use App\Entity\ExpenseReport;
use App\Entity\ExpenseReportType;
use App\Entity\User;
use DateTime;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ExpenseReportTest extends KernelTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

    }

    private function getEntity(): ExpenseReport
    {
        $expenseReport = (new ExpenseReport())
        ->setReportDate(new DateTime())
        ->setAmount(rand(20, 500));
        return $expenseReport;
    }

    private function getOwner() {
        return  (new User())
                    ->setEmail('inside@example.com')
                    ->setPassword('123455678')
                    ->setLastName('Sample Test');
    }

    private function getCompany() {
        return  (new Company())->setName('KissTheBride');
    }

    private function getType() {
        return (new ExpenseReportType())->setName('Essence');
    }

    private function assertHasErrors(ExpenseReport $code, int $number = 0): void
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($code);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(', ', $messages));
    }

    public function testValidEntity()
    {
        $this->assertHasErrors(
            $this->getEntity()
            ->setReportType($this->getType())
            ->setCompany($this->getCompany())
            ->setOwner($this->getOwner())
            , 0);
    }

    public function testInvalidAmountEntity()
    {
        $this->assertHasErrors(
            $this->getEntity()
            ->setReportType($this->getType())
            ->setCompany($this->getCompany())
            ->setOwner($this->getOwner())
            ->setAmount(0)
            , 1);
    }

    public function testInvalidOwnerEntity()
    {
        $this->assertHasErrors(
            $this->getEntity()
                ->setReportType($this->getType())
                ->setCompany($this->getCompany())
            , 1);
    }

    public function testInvalidCompanyEntity()
    {
        $this->assertHasErrors(
            $this->getEntity()
                ->setReportType($this->getType())
                ->setOwner($this->getOwner())
            , 1);
    }

    public function testInvalidTypeEntity()
    {
        $this->assertHasErrors(
            $this->getEntity()
                ->setCompany($this->getCompany())
                ->setOwner($this->getOwner())
            , 1);
    }
    
    protected function tearDown(): void
    {
        parent::tearDown();
    }
}