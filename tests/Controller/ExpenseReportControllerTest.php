<?php

namespace App\Tests\Controller;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ExpenseReportControllerTest extends TestCase
{
    private $client;
    private $token;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost',
        ]);

        // Connexion pour obtenir le token
        $response = $this->client->post('/api/login_check', [
            'json' => [
                'username' => 'user1@example.com',
                'password' => '12345678',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        $this->token = $data['token'];
    }

    public function testListExpenseReports()
    {
        $response = $this->client->get('/api/expense-reports', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetExpenseReport()
    {
        $response = $this->client->get('/api/expense-reports/1', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCreateExpenseReports()
    {
        // Simuler une demande POST avec les données nécessaires
        $response = $this->client->post('/api/expense-reports', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'json' =>  [
                'title' => 'Test Expense Report',
                'amount' => 100.0,
                "report_type" => "repas",
                "company" => "kiss the bride",
                "report_date" => "2023-09-20 04:57:15",
                "registration_date"=> "2023-09-20 04:57:15"
            ],
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testUpdateExpenseReports()
    {
        $response = $this->client->put('/api/expense-reports/1', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'json' =>  [
                "title" => "Test Expense Report",
                "amount" => 100.0,
                "report_type" => "repas",
                "company" => "kiss the bride",
                "report_date" => "2023-09-20 04:57:15",
                "registration_date"=> "2023-09-20 04:57:15"
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDeleteExpenseReports()
    {
        $response = $this->client->delete('/api/expense-reports/1', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $this->assertEquals(204, $response->getStatusCode());
    }
}
