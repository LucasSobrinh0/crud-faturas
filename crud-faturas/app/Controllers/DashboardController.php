<?php
namespace App\Controllers;

use PDO;

class DashboardController
{
    public function __construct(private PDO $pdo) {}

    public function index()
    {
        // métricas rápidas
        $totClients  = $this->pdo->query("SELECT COUNT(*) FROM clients")->fetchColumn();
        $totInvoices = $this->pdo->query("SELECT COUNT(*) FROM invoices")->fetchColumn();
        $totValue    = $this->pdo->query("SELECT COALESCE(SUM(total_value),0) FROM invoices")->fetchColumn();

        // receita por mês (últimos 6)
        $stmt = $this->pdo->query(
            "SELECT DATE_FORMAT(due_date,'%Y-%m') mes,
                    SUM(total_value) total
             FROM invoices
             GROUP BY mes
             ORDER BY mes DESC
             LIMIT 6"
        );
        // inverte p/ cronológico
        $months = array_reverse($stmt->fetchAll(PDO::FETCH_KEY_PAIR)); // ['2025-01'=>1234, ...]
        require dirname(__DIR__).'/Views/dashboard/index.php';
    }

    /* opcional – endpoint JSON só p/ o gráfico */
    public function chart()
    {
        $data = $this->pdo->query(
            "SELECT DATE_FORMAT(due_date,'%Y-%m') mes,
                    SUM(total_value) total
             FROM invoices GROUP BY mes ORDER BY mes"
        )->fetchAll(PDO::FETCH_KEY_PAIR);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
