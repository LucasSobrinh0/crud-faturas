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
