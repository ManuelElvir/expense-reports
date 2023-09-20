<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\ExpenseReport;
use App\Entity\ExpenseReportType;
use App\Repository\ExpenseReportRepository;
use App\Service\ExpenseReportService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpenseReportController extends AbstractController
{

    /**
     * @Route("/api/expense-reports", name="expense_report_list", methods={"GET"})
     */
    public function listExpenseReports(ExpenseReportRepository $expenseReportRepository, Request $request, ExpenseReportService $expenseReportService): JsonResponse
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $page = $request->query->get('page');
        if(!$page || $page<1) {
            $page = 1;
        }
        $limit = $request->query->get('limit');
        if(!$limit) {
            $limit = 20;
        }

        $expenseReports = $expenseReportRepository->findByUser($user->getId(), $limit, $limit*($page-1));
        $expenseReportsJson = [];
        foreach ($expenseReports as $expenseReport) {
            array_push($expenseReportsJson, $expenseReportService->populate($expenseReport));
        }
        return new JSONResponse(json_encode($expenseReportsJson) , Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/expense-reports/{id}", name="expense_report_get", methods={"GET"})
     */
    public function getExpenseReport(ExpenseReportRepository $expenseReportRepository, int $id, ExpenseReportService $expenseReportService): JsonResponse
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $expenseReport = $expenseReportRepository->findOneBy((['owner' => $user->getId(), 'id' => $id]));
        
        if(isset($expenseReport) && $expenseReport) {
            $expenseReportJson = $expenseReportService->populate($expenseReport);
            return new JSONResponse(json_encode($expenseReportJson) , Response::HTTP_OK, [], true);
        }
        return new JSONResponse(json_encode([
            'statusCode' => Response::HTTP_NOT_FOUND, 
            'message' => 'Resource not found']) , Response::HTTP_NOT_FOUND, [], true);
    }


    /**
     * @Route("/api/expense-reports", name="expense_report_create", methods={"POST"})
     */
    public function createExpenseReports(EntityManagerInterface $entityManager, Request $request, ExpenseReportService $expenseReportService): JsonResponse
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $expenseReport = (new ExpenseReport())->setOwner($user);
        try{

            $expenseReport = $expenseReportService->jsonDeserialize($request->getContent(), true, $expenseReport);
            $entityManager->persist($expenseReport);
            $entityManager->flush();
            $expenseReportJson = $expenseReportService->populate($expenseReport);
            return new JSONResponse(json_encode($expenseReportJson), Response::HTTP_CREATED, [], true);
        }
        catch(Exception $e) {
            return new JSONResponse(json_encode([
                'statusCode' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ]), Response::HTTP_BAD_REQUEST, [], true);
        }

    }

    /**
     * @Route("/api/expense-reports/{id}", name="expense_report_update", methods={"PUT"})
     */
    public function updateExpenseReports(EntityManagerInterface $entityManager, Request $request, int $id, ExpenseReportService $expenseReportService): JsonResponse
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $expenseReport = $entityManager->getRepository(ExpenseReport::class)->findOneBy((['owner' => $user->getId(), 'id' => $id]));

        try{
            $expenseReport = $expenseReportService->jsonDeserialize($request->getContent(), false, $expenseReport);
            $entityManager->persist($expenseReport);
            $entityManager->flush();
            $expenseReportJson = $expenseReportService->populate($expenseReport);
            return new JSONResponse(json_encode($expenseReportJson), Response::HTTP_OK, [], true);
        }
        catch(Exception $e) {
            return new JSONResponse(json_encode([
                'statusCode' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ]), Response::HTTP_BAD_REQUEST, [], true);
        }

    }

    /**
     * @Route("/api/expense-reports/{id}", name="expense_report_delete", methods={"DELETE"})
     */
    public function deleteExpenseReports(EntityManagerInterface $entityManager, Request $request, int $id): JsonResponse
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $expenseReport = $entityManager->getRepository(ExpenseReport::class)->findOneBy((['owner' => $user->getId(), 'id' => $id]));

        if(!($expenseReport instanceof ExpenseReport)) {
            return new JSONResponse(json_encode([
                'statusCode' => Response::HTTP_NOT_FOUND, 
                'message' => 'Resource not found']) , Response::HTTP_NOT_FOUND, [], true);
        }

        try{
            
            $entityManager->getRepository(ExpenseReport::class)->remove($expenseReport);
            $entityManager->flush();

            return new JSONResponse('', Response::HTTP_NO_CONTENT, [], true);
        }
        catch(Exception $e) {
            return new JSONResponse(json_encode([
                'statusCode' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ]), Response::HTTP_BAD_REQUEST, [], true);
        }

    }
}
