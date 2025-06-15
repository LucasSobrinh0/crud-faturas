<?php
namespace App\Models;

use PDO;

class Client
{
    private PDO $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function all(string $q = ''): array
{
    if ($q === '') {
        return $this->pdo
            ->query("SELECT * FROM clients ORDER BY id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    $where  = [];
    $params = [];

    /* ID (somente se o termo é inteiro positivo) */
    if (ctype_digit($q)) {
        $where[]  = 'id = ?';
        $params[] = (int) $q;
    }

    /* Razão social / Nome fantasia */
    $like = "%{$q}%";
    $where[]  = 'razao_social  LIKE ?';
    $where[]  = 'nome_fantasia LIKE ?';
    $params[] = $like;
    $params[] = $like;

    /* CNPJ (somente se o termo contém dígitos) */
    $clean = preg_replace('/\D/', '', $q);      // só dígitos
    if ($clean !== '') {
        $where[]  = 'cnpj LIKE ?';
        $params[] = "%{$clean}%";
    }

    $sql = "SELECT * FROM clients
            WHERE " . implode(' OR ', $where) . "
            ORDER BY id DESC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function find(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT * FROM clients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool {
        $sql = "INSERT INTO clients (razao_social, nome_fantasia, cnpj)
                VALUES (?,?,?)";
        return $this->pdo->prepare($sql)
                         ->execute([
                             $data['razao_social'],
                             $data['nome_fantasia'],
                             preg_replace('/\D/', '', $data['cnpj'])
                         ]);
    }

    public function update(int $id, array $data): bool {
        $sql = "UPDATE clients SET razao_social = ?, nome_fantasia = ?, cnpj = ?
                WHERE id = ?";
        return $this->pdo->prepare($sql)
                         ->execute([
                             $data['razao_social'],
                             $data['nome_fantasia'],
                             preg_replace('/\D/', '', $data['cnpj']),
                             $id
                         ]);
    }

    public function delete(int $id): bool {
        return $this->pdo->prepare("DELETE FROM clients WHERE id = ?")
                         ->execute([$id]);
    }
}
