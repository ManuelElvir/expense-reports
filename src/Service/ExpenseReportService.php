<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\ExpenseReport;
use App\Entity\ExpenseReportType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

final class  ExpenseReportService {

    private EntityManagerInterface $entityManager; 

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager; 
    }

    public function populate(ExpenseReport $expenseReport) : array {

        $expenseReportItem = [];

        $expenseReportItem['id'] = $expenseReport->getId();
        $expenseReportItem['amount'] = $expenseReport->getAmount();
        $expenseReportItem['report_type'] = $expenseReport->getReportType()->getName();
        $expenseReportItem['company'] = $expenseReport->getCompany()->getName();
        $expenseReportItem['date'] = $expenseReport->getReportDate()->format('Y-m-d H:i:s');
        $expenseReportItem['registration_date'] = $expenseReport->getRegistrationDate()->format('Y-m-d H:i:s');

        return $expenseReportItem;
    }

    public function jsonDeserialize(string $data, bool $strict = false, ExpenseReport $expenseReport) : ExpenseReport {
        
        $data = json_decode($data, true);

        // Map the report date if available and necessary
        if($strict && !isset($data['report_date'])) {
            throw new Exception('Invalid report date');
        }
        else if(isset($data['report_date'])){
            $expenseReport->setReportDate(new \DateTime($data['report_date']));
        }

        // Map the registration date if available and necessary
        if($strict && !isset($data['registration_date'])) {
            throw new Exception('Invalid registration date');
        }
        else if(isset($data['registration_date'])){
            $expenseReport->setRegistrationDate(new \DateTime($data['registration_date']));
        }


        // Map the amount if available and necessary
        if($strict && !isset($data['amount'])) {
            throw new Exception('Invalid amount');
        }
        else if(isset($data['amount'])){
            $expenseReport->setAmount((int) $data['amount']);
        }

        if($strict && !isset($data['company'])) {
            throw new Exception('Invalid company');
        }
        else if(isset($data['company'])) {
            //On vérfie si la société n'existe pas déjà, sinon on la crée
            $company = $this->entityManager->getRepository(Company::class)->findOneBy(['name' => strtolower($data['company'])]);
            if(!($company instanceof Company)) {
                $company = (new Company())->setName($data['company']);
            }
            $expenseReport->setCompany($company);
        }

        if($strict && !isset($data['report_type'])) {
            throw new Exception('Invalid report_type');
        }
        else if(isset($data['report_type'])) {
            // On vérifie si le type de note de frais n'existe pas déjà, sinon on la crée
            $report_type = $this->entityManager->getRepository(ExpenseReportType::class)->findOneBy(['name' => strtolower($data['report_type'])]);
            if(!($report_type instanceof ExpenseReportType)) {
                $report_type = (new ExpenseReportType())->setName($data['report_type']);
            }
            $expenseReport->setReportType($report_type);
        }

        return $expenseReport;

    }
}
