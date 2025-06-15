<?php
namespace App\Models;

use PDO;

class Invoice
{
    public function all(array $f = []): array
{
    // $f = ['cliente' => '', 'referencia' => '', 'operadora' => '']
    $where = [];
    $params = [];

    if (!empty($f['cliente'])) {
        $where[]  = 'c.nome_fantasia LIKE ?';
        $params[] = "%{$f['cliente']}%";
    }
if (!empty($f['referencia'])) {
    // “YYYY-MM” vindo do <input type="month">
    $where[]  = 'DATE_FORMAT(i.reference, "%Y-%m") = ?';
    $params[] = $f['referencia'];
}
    if (!empty($f['operadora'])) {
        $where[]  = 'i.operator LIKE ?';
        $params[] = "%{$f['operadora']}%";
    }

    $sql = "SELECT i.*, c.nome_fantasia, c.cnpj
              FROM invoices i
              JOIN clients c ON c.id = i.client_id";

    if ($where) {
        $sql .= ' WHERE ' . implode(' AND ', $where);
    }

    $sql .= ' ORDER BY i.due_date DESC';

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
private function refToDate(string $in): string
{
    // “2025-05” → “2025-05-01”
    return $in . '-01';
}

    public function __construct(private PDO $pdo) {}

    public function find(int $id): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data, ?array $file): bool
    {
        /* 1. trata upload ------------------------------------ */
        $path = null;
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $fn   = uniqid().'.pdf';
            $dest = dirname(__DIR__,2)."/public/uploads/$fn";
            move_uploaded_file($file['tmp_name'], $dest);
            $path = "uploads/$fn";
        }

        /* 2. formata valor e referência ---------------------- */
        $total = str_replace(['.', ','], ['', '.'], $data['total_value']); // "1.234,56" → 1234.56
        $ref   = $this->refToDate($data['reference']);                     // "2025-05" → "2025-05-01"

        /* 3. grava ------------------------------------------ */
        $sql = "INSERT INTO invoices
                (client_id, due_date, total_value, reference, contract_number, operator, pdf_path)
                VALUES (?,?,?,?,?,?,?)";

        return $this->pdo->prepare($sql)->execute([
            $data['client_id'],
            $data['due_date'],
            $total,
            $ref,
            $data['contract_number'] ?? null,
            $data['operator'] ?? null,
            $path
        ]);
    }

    public function update(int $id, array $data, ?array $file): bool
    {
        /* 1. mantém/atualiza PDF ----------------------------- */
        $invoice = $this->find($id);
        $path = $invoice['pdf_path'];

        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $fn   = uniqid().'.pdf';
            $dest = dirname(__DIR__,2)."/public/uploads/$fn";
            move_uploaded_file($file['tmp_name'], $dest);
            $path = "uploads/$fn";
        }

        /* 2. formata ---------------------------------------- */
        $total = str_replace(['.', ','], ['', '.'], $data['total_value']);
        $ref   = $this->refToDate($data['reference']);

        /* 3. update ----------------------------------------- */
        $sql = "UPDATE invoices SET
                  client_id = ?, due_date = ?, total_value = ?, reference = ?,
                  contract_number = ?, operator = ?, pdf_path = ?
                WHERE id = ?";

        return $this->pdo->prepare($sql)->execute([
            $data['client_id'],
            $data['due_date'],
            $total,
            $ref,
            $data['contract_number'] ?? null,
            $data['operator'] ?? null,
            $path,
            $id
        ]);
    }

public function delete(int $id): bool
    {
        return $this->pdo->prepare("DELETE FROM invoices WHERE id = ?")
                         ->execute([$id]);
    }
}

