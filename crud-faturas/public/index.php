<?php
// Autoload MUITO simples
spl_autoload_register(function ($class) {
    $path = dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) require $path;
});

$config = require dirname(__DIR__) . '/config/config.php';
$pdo = new PDO(
    "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
    $config['db']['user'],
    $config['db']['pass'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// Roteamento super-básico (?controller=&action=&id=)
$controller  = $_GET['controller'] ?? 'client';
$action      = $_GET['action']     ?? 'index';
$id          = $_GET['id']         ?? null;

$controllerClass = 'App\\Controllers\\' . ucfirst($controller) . 'Controller';
$instance = new $controllerClass($pdo);
call_user_func([$instance, $action], $id);