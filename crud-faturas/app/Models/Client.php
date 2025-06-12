<?php
# crud-faturas/app/Models/Client.php
namespace App\Models;
use App\DB; use PDO;
class Client {
  public static function all(): array {return DB::conn()->query("SELECT * FROM clients")->fetchAll(PDO::FETCH_ASSOC);}  
  public static function find(int $id){$st=DB::conn()->prepare("SELECT * FROM clients WHERE id=?");$st->execute([$id]);return $st->fetch(PDO::FETCH_ASSOC);}  
  public static function create(array $d): void {DB::conn()->prepare("INSERT INTO clients (razao_social,nome_fantasia,cnpj) VALUES (?,?,?)") ->execute([$d['razao_social'],$d['nome_fantasia'],preg_replace('/\D/','',$d['cnpj'])]);}  
  public static function update(int $id,array $d):void {DB::conn()->prepare("UPDATE clients SET razao_social=?, nome_fantasia=?, cnpj=? WHERE id=?") ->execute([$d['razao_social'],$d['nome_fantasia'],preg_replace('/\D/','',$d['cnpj']),$id]);}
  public static function delete(int $id):void {DB::conn()->prepare("DELETE FROM clients WHERE id=?")->execute([$id]);}
}