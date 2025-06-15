<?php
namespace App\Models;

use PDO;

class InvoiceLine
{
    public function __construct(private PDO $pdo) {}

    /** Todas as linhas de uma fatura */
    public function all(int $invoiceId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM invoice_lines WHERE invoice_id = ? ORDER BY id"
        );
        $stmt->execute([$invoiceId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

 public function create(array $data): bool
{
    // 1. moeda - ponto decimal
    $valor = str_replace(['.', ','], ['', '.'], $data['line_value']);

    // 2. telefone - somente dígitos
    $phone = preg_replace('/\D/', '', $data['line_number']);

    // 3. grava
    $sql = "INSERT INTO invoice_lines (invoice_id, line_number, line_value)
            VALUES (?,?,?)";

    return $this->pdo->prepare($sql)->execute([
        $data['invoice_id'],
        $phone,
        $valor
    ]);
}


    public function find(int $id): array|false
    {
        $s = $this->pdo->prepare("SELECT * FROM invoice_lines WHERE id=?");
        $s->execute([$id]); return $s->fetch(PDO::FETCH_ASSOC);
    }

    public function update(int $id, array $d): bool
{
    $valor = str_replace(['.', ','], ['', '.'], $d['line_value']);
    $phone = preg_replace('/\D/', '', $d['line_number']);

    $sql = "UPDATE invoice_lines SET line_number=?, line_value=? WHERE id=?";

    return $this->pdo->prepare($sql)->execute([
        $phone,
        $valor,
        $id
    ]);
}

    public function delete(int $id): bool
    {
        return $this->pdo->prepare("DELETE FROM invoice_lines WHERE id=?")
                         ->execute([$id]);
    }
}
