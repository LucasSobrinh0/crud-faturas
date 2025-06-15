<?php include '../app/Views/partials/header.php'; ?>

<h2 class="mb-3">Faturas</h2>

<!-- FILTROS -->
<form class="row g-2 mb-4" method="GET" action="">
  <input type="hidden" name="controller" value="invoice">
  <input type="hidden" name="action"     value="index">

  <div class="col-md-4">
    <input name="cliente" class="form-control" id="f-cliente"
           placeholder="Filtrar por cliente"
           value="<?= htmlspecialchars($_GET['cliente'] ?? '') ?>">
  </div>

<div class="col-md-3">
  <input type="month" name="referencia" class="form-control" id="f-ref"
         value="<?= htmlspecialchars($_GET['referencia'] ?? '') ?>">
</div>

  <div class="col-md-3">
    <input name="operadora" class="form-control" id="f-operadora"
           placeholder="Operadora"
           value="<?= htmlspecialchars($_GET['operadora'] ?? '') ?>">
  </div>

  <div class="col-md-2 d-grid">
    <button class="btn btn-primary">Aplicar</button>
  </div>
</form>

<div class="table-responsive">
<table class="table table-hover align-middle">
  <thead class="">
    <tr>
      <th>Cliente</th>
      <th>CNPJ</th>
      <th>Operadora</th>
      <th>Referência</th>
      <th>Vencimento</th>
      <th class="text-end">Valor total</th>
      <th>Ações</th>
      <th>Linhas</th>
    </tr>
  </thead>
  <tbody id="invoice-body">
  <?php foreach ($invoices as $inv): ?>
    <tr>
      <td><?= htmlspecialchars($inv['nome_fantasia']) ?></td>
      <td><?= preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $inv['cnpj']) ?></td>
      <td><?= htmlspecialchars($inv['operator']) ?></td>
      <td><?= date('Y-m', strtotime($inv['reference'])) ?></td>
      <td><?= date('d/m/Y', strtotime($inv['due_date'])) ?></td>
      <td class="text-end">R$ <?= number_format($inv['total_value'],2,',','.') ?></td>
      <td>
        <a class="btn btn-outline-primary"
           href="/?controller=invoice&action=edit&id=<?= $inv['id'] ?>">Editar</a>
        <?php if ($inv['pdf_path']): ?>
          <a class="btn btn-outline-dark"
             href="/<?= $inv['pdf_path'] ?>" target="_blank">Documento</a>
        <?php else: ?>
          <span class="badge text-bg-secondary">—</span>
        <?php endif; ?>
        <a class="btn btn-outline-danger" href="/?controller=invoice&action=delete&id=<?= $inv['id']?>"
        onclick="return confirm('Confirma excluir?')">Excluir</a>
      </td>
<td>
  <a class="btn btn-primary"
     href="/?controller=invoiceline&action=index&id=<?= $inv['id'] ?>">
     Ver linhas
     <?php if (isset($inv['line_count'])): ?>
        <span class="badge bg-light text-dark"><?= $inv['line_count'] ?></span>
     <?php endif; ?>
  </a>
</td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>

<a href="/?controller=invoice&action=create" class="btn btn-success mt-3">+ Nova fatura</a>

<?php include '../app/Views/partials/footer.php'; ?>
