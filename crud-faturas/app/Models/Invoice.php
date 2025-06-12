<?php
# # crud-faturas/app/Models/Invoice.php
namespace App\Models; use App\DB; use PDO;
class Invoice {
  public static function all(array $f=[]):array{ $sql="SELECT i.*,c.nome_fantasia,c.cnpj FROM invoices i JOIN clients c ON c.id=i.client_id WHERE 1=1"; $p=[]; if(!empty($f['cliente'])){$sql.=" AND c.nome_fantasia LIKE :c";$p[':c']='%'.$f['cliente'].'%';} if(!empty($f['referencia'])){$sql.=" AND i.referencia LIKE :r";$p[':r']='%'.$f['referencia'].'%';} if(!empty($f['operadora'])){$sql.=" AND i.operadora LIKE :o";$p[':o']='%'.$f['operadora'].'%';} $st=DB::conn()->prepare($sql);$st->execute($p);return $st->fetchAll(PDO::FETCH_ASSOC);}  
  public static function find(int $id){$st=DB::conn()->prepare("SELECT i.*,c.nome_fantasia,c.cnpj FROM invoices i JOIN clients c ON c.id=i.client_id WHERE i.id=?");$st->execute([$id]);return $st->fetch(PDO::FETCH_ASSOC);}  
  public static function create(array $d,string $pdf):void{DB::conn()->prepare("INSERT INTO invoices (client_id,vencimento,valor_total,referencia,contrato,operadora,pdf) VALUES (?,?,?,?,?,?,?)") ->execute([$d['client_id'],$d['vencimento'],$d['valor_total'],$d['referencia'],$d['contrato'],$d['operadora'],$pdf]);}
  public static function update(int $id,array $d,string $pdf=null):void{ $setPdf=$pdf?", pdf=?":""; $sql="UPDATE invoices SET client_id=?,vencimento=?,valor_total=?,referencia=?,contrato=?,operadora=?$setPdf WHERE id=?"; $params=[$d['client_id'],$d['vencimento'],$d['valor_total'],$d['referencia'],$d['contrato'],$d['operadora']]; if($pdf)$params[]=$pdf; $params[]=$id; DB::conn()->prepare($sql)->execute($params);}  
  public static function delete(int $id):void{DB::conn()->prepare("DELETE FROM invoices WHERE id=?")->execute([$id]);}
  public static function totals():array{return DB::conn()->query("SELECT COUNT(*) qtd, SUM(valor_total) total FROM invoices")->fetch(PDO::FETCH_ASSOC);} }
