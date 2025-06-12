<?php
# crud-faturas/app/dashboard/index.php
?><!doctype html><html><head><link href="/crud-faturas/public/assets/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<h2>Dashboard</h2>
<div class="row g-4">
  <div class="col-md-4"><div class="card text-center p-3"><h4>Total de Clientes</h4><p class="display-5"><?= $totCli ?></p></div></div>
  <div class="col-md-4"><div class="card text-center p-3"><h4>Total de Faturas</h4><p class="display-5"><?= $totInv['qtd'] ?></p></div></div>
  <div class="col-md-4"><div class="card text-center p-3"><h4>Valor Acumulado</h4><p class="display-5">R$ <?= number_format($totInv['total'],2,',','.') ?></p></div></div>
</div>
</body></html>