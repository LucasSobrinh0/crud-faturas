<?php

namespace App\Controllers;

use App\Models\Client;
use PDO;

class ClientController
{
    private Client $model;

    private string $viewPath;

    public function __construct(PDO $pdo)
    {
        $this->model = new Client($pdo);
        $this->viewPath = dirname(__DIR__) . '/Views/clients/';
    }
    

public function index()
{
    $q = $_GET['q'] ?? '';
    $clients = $this->model->all($q);
    require $this->viewPath . 'index.php';
}

    public function create()
    {
        require $this->viewPath . 'create.php';
    }

    public function edit($id)
    {
        $client = $this->model->find($id);
        require $this->viewPath . 'edit.php';
    }

    public function store()
    {
        $this->model->create($_POST);
        header('Location: /?controller=client&action=index');
        exit;
    }

        public function update($id)  // ← ATUALIZAR existente
    {
        $this->model->update($id, $_POST);
        header('Location: /?controller=client&action=index');
        exit;
    }

        public function delete($id)
    {
        $this->model->delete($id);
        header('Location: /?controller=client&action=index');
        exit;
    }
    public function json()
{
    $q = $_GET['q'] ?? '';
    $clients = $this->model->all($q);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($clients);
    exit;
}
}
