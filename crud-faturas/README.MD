## 1 - XAMPP Control Panel - Iniciar Apache e MySQL

## 2 - Acessar http://localhost/phpmyadmin

## 3 - Entrar no diretório C:\xampp\htdocs e criar o projeto.

## 4 - Criar o .htaccess dentro da pasta public

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]

## 5 - Configurando MySQL e banco de dados

----------------------------------------------------------------------------------------------

CREATE DATABASE crud_faturas
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;
USE crud_faturas;

CREATE TABLE clients (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  razao_social  VARCHAR(255) NOT NULL,
  nome_fantasia VARCHAR(255) NOT NULL,
  cnpj          CHAR(14)     NOT NULL UNIQUE
);

CREATE TABLE invoices (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  client_id    INT          NOT NULL,
  vencimento   DATE         NOT NULL,
  valor_total  DECIMAL(10,2) NOT NULL,
  referencia   VARCHAR(20),
  contrato     VARCHAR(50),
  operadora    VARCHAR(50),
  pdf          VARCHAR(255),
  FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
);

CREATE TABLE invoice_lines (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  invoice_id   INT          NOT NULL,
  numero_linha VARCHAR(20)  NOT NULL,
  valor        DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE
);

----------------------------------------------------------------------------------------------

/config/database.php

<?php
return [
    'host' => 'localhost',
    'name' => 'crud_faturas',
    'user' => 'root',   // ajuste se mudou a senha
    'pass' => '',
];

----------------------------------------------------------------------------------------------

/app/DB.php

<?php
namespace App;

use PDO;

class DB
{
    private static PDO $conn;

    public static function conn(): PDO
    {
        if (!isset(self::$conn)) {
            $cfg = require __DIR__ . '/../config/database.php';
            self::$conn = new PDO(
                "mysql:host={$cfg['host']};dbname={$cfg['name']};charset=utf8mb4",
                $cfg['user'],
                $cfg['pass'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$conn;
    }
}

## 6 - Após configurar, digite "composer init" Exemplo abaixo.

package name: php-crud/faturas (ou o nome que quiser)

description: Projeto CRUD de faturas em PHP

author: seu nome

minimum-stability: stable

Quando perguntar se quer salvar, digite yes

## 6.1 - composer init --name="php-crud/faturas" --description="CRUD de faturas telefônicas em PHP" --author="Seu Nome <email@exemplo.com>" --require="" --autoload="psr-4:{\"App\\\\\":\"app/\"}" --no-interaction

## 7 - Abra o composer.json recém-gerado e adicione:

"autoload": {
  "psr-4": {
    "App\\": "app/"
  }
}

## 8 - Após, digite "composer dump-autoload"

