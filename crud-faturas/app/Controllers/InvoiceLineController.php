<?php
namespace App\Controllers;

use App\Models\InvoiceLine;
use App\Models\Invoice;
use PDO;

class InvoiceLineController
{
    private InvoiceLine $model;
    private Invoice     $invoiceModel;
    private string      $viewPath;

    public function __construct(PDO $pdo)
    {
        $this->model        = new InvoiceLine($pdo);
        $this->invoiceModel = new Invoice($pdo);
        $this->viewPath     = dirname(__DIR__) . '/Views/lines/';
    }
    

    /** Lista linhas de uma fatura */
    public function index($invoiceId)
    {
        $invoice = $this->invoiceModel->find($invoiceId);
        $lines   = $this->model->all($invoiceId);
        require $this->viewPath . 'index.php';
    }

    public function create($invoiceId)
    {
        $invoice = $this->invoiceModel->find($invoiceId);
        require $this->viewPath . 'create.php';
    }

    public function store()
    {
        $this->model->create($_POST);
        header("Location: /?controller=invoiceline&action=index&id={$_POST['invoice_id']}"); exit;
    }

    public function edit($id)
    {
        $line    = $this->model->find($id);
        $invoice = $this->invoiceModel->find($line['invoice_id']);
        require $this->viewPath . 'edit.php';
    }

    public function update($id)
    {
        $this->model->update($id, $_POST);
        header("Location: /?controller=invoiceline&action=index&id={$_POST['invoice_id']}"); exit;
    }

    public function delete($id)
    {
        $line = $this->model->find($id);
        $this->model->delete($id);
        header("Location: /?controller=invoiceline&action=index&id={$line['invoice_id']}"); exit;
    }
}
