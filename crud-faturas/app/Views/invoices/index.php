<?php
# crud-faturas/app/invoices/index.php
?><!doctype html><html><head>
  <link href="/crud-faturas/public/assets/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
  <h3>Faturas</h3>
  <a href="/crud-faturas/public/invoices/create" class="btn btn-primary mb-2">Nova Fatura</a>

  <form method="get" class="mb-3">
    <div class="row g-2">
      <div class="col">
        <input type="text" name="cliente" placeholder="Cliente" value="<?= htmlspecialchars($_GET['cliente'] ?? '') ?>" class="form-control">
      </div>
      <div class="col">
        <input type="text" name="referencia" placeholder="Referência" value="<?= htmlspecialchars($_GET['referencia'] ?? '') ?>" class="form-control">
      </div>
      <div class="col">
        <input type="text" name="operadora" placeholder="Operadora" value="<?= htmlspecialchars($_GET['operadora'] ?? '') ?>" class="form-control">
      </div>
      <div class="col">
        <button class="btn btn-outline-primary">Filtrar</button>
        <a href="/crud-faturas/public/invoices" class="btn btn-outline-secondary">Limpar</a>
      </div>
    </div>
  </form>

  <table class="table table-bordered">
    <thead>
      <tr><th>Cliente</th><th>CNPJ</th><th>Operadora</th><th>Referência</th><th>Vencimento</th><th>Valor</th><th>PDF</th></tr>
    </thead>
    <tbody>
      <?php foreach ($invoices as $f): ?>
        <tr>
          <td><?= $f['nome_fantasia'] ?></td>
          <td><?= $f['cnpj'] ?></td>
          <td><?= $f['operadora'] ?></td>
          <td><?= $f['referencia'] ?></td>
          <td><?= $f['vencimento'] ?></td>
          <td>R$ <?= number_format($f['valor_total'], 2, ',', '.') ?></td>
          <td><a href="<?= $f['pdf'] ?>" target="_blank">Ver PDF</a></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body></html>
