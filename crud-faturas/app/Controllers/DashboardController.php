<?php
# crud-faturas/app/Controllers/DashboardController.php
namespace App\Controllers; use App\Models\Invoice; use App\Models\Client; class DashboardController{public function index(){ $totInv=Invoice::totals(); $totCli=count(Client::all()); require __DIR__.'/../Views/dashboard/index.php';}}

// Função auxiliar de upload (pode ir em app/helpers.php)
function uploadPdf(bool $optional=false){ if(isset($_FILES['pdf']) && $_FILES['pdf']['error']==UPLOAD_ERR_OK){ $ext=pathinfo($_FILES['pdf']['name'],PATHINFO_EXTENSION); if($ext==='pdf'){ $fname=uniqid().'.pdf'; move_uploaded_file($_FILES['pdf']['tmp_name'], __DIR__.'/../../uploads/'.$fname); return '/crud-faturas/uploads/'.$fname; } } return $optional?null:''; }
