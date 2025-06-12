<?php
require_once __DIR__ . '/../vendor/autoload.php';

$url = $_GET['url'] ?? 'clients/index';
$parts = array_filter(explode('/', trim($url, '/')));

$controller = ucfirst($parts[0] ?? 'Clients') . 'Controller';
$method     = $parts[1] ?? 'index';
$params     = array_slice($parts, 2);

$path = __DIR__ . "/../app/Controllers/{$controller}.php";

if (file_exists($path)) {
    require_once $path;
    $fullClass = "App\\Controllers\\{$controller}";
    $instance  = new $fullClass;
    call_user_func_array([$instance, $method], $params);
} else {
    http_response_code(404);
    echo '404 – Página não encontrada';
}
