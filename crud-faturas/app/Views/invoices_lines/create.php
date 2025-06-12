<?php
# crud-faturas/app/invoices_lines/create.php
?><!doctype html><html><head>
  <link href="/crud-faturas/public/assets/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
  <h3>Adicionar Linha</h3>
  <form action="/crud-faturas/public/invoicelines/store" method="post">
    <input type="hidden" name="invoice_id" value="<?= $_GET['url'] ? explode('/', $_GET['url'])[2] : '' ?>">
    <div class="mb-2">
      <label>Número da Linha</label>
      <input name="numero_linha" class="form-control" required>
    </div>
    <div class="mb-2">
      <label>Valor</label>
      <input name="valor" type="number" step="0.01" class="form-control" required>
    </div>
    <button class="btn btn-success">Salvar</button>
    <a href="/crud-faturas/public/invoices" class="btn btn-secondary">Cancelar</a>
  </form>
</body></html>
