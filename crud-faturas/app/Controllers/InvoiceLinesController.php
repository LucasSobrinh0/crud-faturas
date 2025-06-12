<?php
# crud-faturas/app/Controllers/InvoiceLinesController.php
namespace App\Controllers;

use App\Models\Invoice;
use App\Models\Client;

class InvoicesController
{
    public function index()
    {
        $filters = [
            'cliente' => $_GET['cliente'] ?? '',
            'referencia' => $_GET['referencia'] ?? '',
            'operadora' => $_GET['operadora'] ?? '',
        ];

        $invoices = Invoice::all($filters);
        require __DIR__ . '/../Views/invoices/index.php';
    }

    public function create()
    {
        $clients = Client::all();
        require __DIR__ . '/../Views/invoices/create.php';
    }

    public function store()
    {
        $filePath = null;

        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
            if ($ext === 'pdf') {
                $fileName = uniqid() . ".pdf";
                $filePath = "/crud-faturas/uploads/{$fileName}";
                move_uploaded_file($_FILES['pdf']['tmp_name'], __DIR__ . "/../../uploads/{$fileName}");
            }
        }

        Invoice::create($_POST, $filePath);
        header('Location: /crud-faturas/public/invoices');
        exit;
    }
}