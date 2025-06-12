<?php
# crud-faturas/app/Controllers/InvoicesController.php
namespace App\Controllers; use App\Models\Invoice; use App\Models\Client; use App\Models\InvoiceLine;
class InvoicesController {
  public function index(){ $f=['cliente'=>$_GET['cliente']??'','referencia'=>$_GET['referencia']??'','operadora'=>$_GET['operadora']??'']; $invoices=Invoice::all($f); require __DIR__.'/../Views/invoices/index.php'; }
  public function create(){ $clients=Client::all(); require __DIR__.'/../Views/invoices/create.php'; }
  public function store(){ $pdf=uploadPdf(); Invoice::create($_POST,$pdf); header('Location: /crud-faturas/public/invoices'); }
  public function show($id){ $inv=Invoice::find($id); $lines=InvoiceLine::allByInvoice($id); require __DIR__.'/../Views/invoices/show.php'; }
  public function edit($id){ $inv=Invoice::find($id); $clients=Client::all(); require __DIR__.'/../Views/invoices/edit.php'; }
  public function update($id){ $pdf=uploadPdf(true); Invoice::update($id,$_POST,$pdf); header('Location: /crud-faturas/public/invoices'); }
  public function delete($id){ Invoice::delete($id); header('Location: /crud-faturas/public/invoices'); }
}