<?php
# crud-faturas/app/invoices/create.php
?><!doctype html><html><head>
  <link href="/crud-faturas/public/assets/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
  <h3>Nova Fatura</h3>
  <form action="/crud-faturas/public/invoices/store" method="post" enctype="multipart/form-data">
    <div class="mb-2">
      <label>Cliente</label>
      <select name="client_id" class="form-control">
        <?php foreach ($clients as $c): ?>
          <option value="<?= $c['id'] ?>"><?= $c['nome_fantasia'] ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="mb-2"><label>Vencimento</label><input name="vencimento" type="date" class="form-control"></div>
    <div class="mb-2"><label>Valor Total</label><input name="valor_total" type="number" step="0.01" class="form-control"></div>
    <div class="mb-2"><label>Referência</label><input name="referencia" class="form-control"></div>
    <div class="mb-2"><label>Contrato</label><input name="contrato" class="form-control"></div>
    <div class="mb-2"><label>Operadora</label><input name="operadora" class="form-control"></div>
    <div class="mb-2"><label>Arquivo PDF</label><input type="file" name="pdf" accept="application/pdf" class="form-control"></div>
    <button class="btn btn-success">Salvar</button>
    <a href="/crud-faturas/public/invoices" class="btn btn-secondary">Cancelar</a>
  </form>
</body></html>
