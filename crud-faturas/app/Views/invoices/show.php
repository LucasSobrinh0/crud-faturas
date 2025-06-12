<?php
# crud-faturas/app/invoices/show.php
?>
<!doctype html><html><head><link href="/crud-faturas/public/assets/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<h3>Fatura #<?= $inv['id'] ?> - <?= $inv['nome_fantasia'] ?></h3>
<p><strong>Valor:</strong> R$ <?= number_format($inv['valor_total'],2,',','.') ?> | <strong>Vencimento:</strong> <?= $inv['vencimento'] ?> | <strong>Operadora:</strong> <?= $inv['operadora'] ?></p>
<a href="<?= $inv['pdf'] ?>" target="_blank" class="btn btn-outline-primary mb-3">Ver PDF</a>
<h4>Linhas</h4>
<table class="table table-bordered"><thead><tr><th>Nº</th><th>Valor</th></tr></thead><tbody><?php foreach($lines as $l):?><tr><td><?= $l['numero_linha'] ?></td><td>R$ <?= number_format($l['valor'],2,',','.') ?></td></tr><?php endforeach;?></tbody></table>
<a href="/crud-faturas/public/invoicelines/create/<?= $inv['id'] ?>" class="btn btn-primary">Adicionar Linha</a>
</body></html>