<?php
# crud-faturas/app/Models/InvoiceLine.php
namespace App\Models;

use App\DB;
use PDO;

class InvoiceLine
{
    public static function allByInvoice(int $invoiceId): array
    {
        $sql = "SELECT * FROM invoice_lines WHERE invoice_id = ?";
        $stmt = DB::conn()->prepare($sql);
        $stmt->execute([$invoiceId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): void
    {
        $sql = "INSERT INTO invoice_lines (invoice_id, numero_linha, valor)
                VALUES (:invoice_id, :numero_linha, :valor)";
        DB::conn()->prepare($sql)->execute([
            ':invoice_id' => $data['invoice_id'],
            ':numero_linha' => $data['numero_linha'],
            ':valor' => $data['valor'],
        ]);
    }
}
