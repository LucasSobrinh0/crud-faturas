<?php
namespace App\Controllers;

use App\Models\Invoice;
use App\Models\Client;
use PDO;

class InvoiceController
{
    private Invoice $model;
    private Client  $clientModel;
    private string  $viewPath;

    public function __construct(PDO $pdo)
    {
        $this->model       = new Invoice($pdo);
        $this->clientModel = new Client($pdo);
        $this->viewPath    = dirname(__DIR__) . '/Views/invoices/';
    }
    // app/Controllers/InvoiceController.php   (adicione no final da classe)
public function json()
{
    $filters = [
        'cliente'    => $_GET['cliente']    ?? '',
        'referencia' => $_GET['referencia'] ?? '',
        'operadora'  => $_GET['operadora']  ?? '',
    ];

    $invoices = $this->model->all($filters);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($invoices);
    exit;
}


public function index()
{
    // captura parâmetros vindos do formulário GET
    $filters = [
        'cliente'    => $_GET['cliente']    ?? '',
        'referencia' => $_GET['referencia'] ?? '',
        'operadora'  => $_GET['operadora']  ?? '',
    ];

    // passa o array para o model
    $invoices = $this->model->all($filters);

    require $this->viewPath . 'index.php';
}

    public function create()
    {
        $clients = $this->clientModel->all();
        require $this->viewPath . 'create.php';
    }

    public function store()
    {
        $this->model->create($_POST, $_FILES['pdf'] ?? null);
        header('Location: /?controller=invoice&action=index'); exit;
    }

    public function edit($id)
    {
        $invoice = $this->model->find($id);
        $clients = $this->clientModel->all();
        require $this->viewPath . 'edit.php';
    }

    public function update($id)
    {
        $this->model->update($id, $_POST, $_FILES['pdf'] ?? null);
        header('Location: /?controller=invoice&action=index'); exit;
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header('Location: /?controller=invoice&action=index'); exit;
    }
}
