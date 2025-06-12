<?php
# crud-faturas/app/Controllers/ClientsController.php
namespace App\Controllers; use App\Models\Client;
class ClientsController {
  public function index(){ $clients=Client::all(); require __DIR__.'/../Views/clients/index.php'; }
  public function create(){require __DIR__.'/../Views/clients/create.php';}
  public function store(){Client::create($_POST); header('Location: /crud-faturas/public/clients');}
  public function edit($id){$c=Client::find($id); require __DIR__.'/../Views/clients/edit.php';}
  public function update($id){Client::update($id,$_POST); header('Location: /crud-faturas/public/clients');}
  public function delete($id){Client::delete($id); header('Location: /crud-faturas/public/clients');}
}