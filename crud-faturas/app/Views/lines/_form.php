<?php
function lineForm(array $line, int $invoiceId, string $action, string $title) {
  include '../app/Views/partials/header.php'; ?>
  <h2><?= $title ?> (Fatura #<?= $invoiceId ?>)</h2>

  <form action="<?= $action ?>" method="POST" class="row g-3">
    <input type="hidden" name="invoice_id" value="<?= $invoiceId ?>">
    <div class="col-md-6">
      <label class="form-label">Número da linha</label>
      <input name="line_number" class="form-control phone" type="text"
             value="<?= $line['line_number'] ?? '' ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Valor (R$)</label>
      <input name="line_value" type="text" class="form-control money"
             value="<?= isset($line['line_value'])
             ? number_format($line['line_value'], 2,',', '.') : '' ?>" required>
    </div>
    <div class="col-12">
      <button class="btn btn-success">Salvar</button>
      <a href="/?controller=invoiceline&action=index&id=<?= $invoiceId ?>"
         class="btn btn-secondary" onclick="return confirm('Confirma cancelar?')">Cancelar</a>
    </div>
  </form>
<?php include '../app/Views/partials/footer.php'; }
