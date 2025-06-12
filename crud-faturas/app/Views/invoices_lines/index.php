<?php
# crud-faturas/app/invoices_lines/index.php

?><!doctype html><html><head>
  <link href="/crud-faturas/public/assets/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
  <h3>Linhas da Fatura #<?= $invoiceId ?></h3>
  <a href="/crud-faturas/public/invoicelines/create/<?= $invoiceId ?>" class="btn btn-primary mb-2">Adicionar Linha</a>
  <table class="table table-bordered">
    <thead><tr><th>Número da Linha</th><th>Valor</th></tr></thead>
    <tbody>
      <?php foreach ($lines as $l): ?>
        <tr>
          <td><?= $l['numero_linha'] ?></td>
          <td>R$ <?= number_format($l['valor'], 2, ',', '.') ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body></html>
