<?php
function invoiceForm(array $invoice = [], array $clients = [], string $action, string $title) {
  include '../app/Views/partials/header.php'; ?>
  <h2><?= $title ?></h2>
  <form action="<?= $action ?>" method="POST" enctype="multipart/form-data" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Cliente</label>
      <select name="client_id" class="form-select" required>
        <option value="">Selecione…</option>
        <?php foreach ($clients as $c): ?>
          <option value="<?= $c['id'] ?>"
            <?= ($invoice['client_id'] ?? '') == $c['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($c['nome_fantasia']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-3">
      <label class="form-label">Vencimento</label>
      <input type="date" name="due_date" class="form-control"
             value="<?= $invoice['due_date'] ?? '' ?>" required>
    </div>

    <div class="col-md-3">
      <label class="form-label">Valor total (R$)</label>
 <input type="text" name="total_value"
        class="form-control money"
        value="<?= isset($invoice['total_value'])
                 ? number_format($invoice['total_value'], 2, ',', '.') : '' ?>" required>
    </div>

  <div class="col-md-3">
    <label class="form-label">Referência (mês)</label>
    <input type="month" name="reference" class="form-control"
            value="<?= isset($invoice['reference'])
                ? date('Y-m', strtotime($invoice['reference'])) : '' ?>" required>
  </div>

    <div class="col-md-3">
      <label class="form-label">Nº contrato</label>
      <input type="text" name="contract_number" class="form-control"
             value="<?= $invoice['contract_number'] ?? '' ?>">
    </div>

    <div class="col-md-3">
      <label class="form-label">Operadora</label>
      <input type="text" name="operator" class="form-control"
             value="<?= $invoice['operator'] ?? '' ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label">Arquivo PDF (opcional)</label>
      <input type="file" name="pdf" accept="application/pdf" class="form-control">
      <?php if (!empty($invoice['pdf_path'])): ?>
        <small class="text-muted">Atual: <a href="/<?= $invoice['pdf_path'] ?>" target="_blank">ver</a></small>
      <?php endif; ?>
    </div>

    <div class="col-12">
      <button class="btn btn-success">Salvar</button>
      <a href="/?controller=invoice&action=index" class="btn btn-secondary"
      onclick="return confirm('Confirma cancelar?')">Cancelar</a>
    </div>
  </form>
<?php include '../app/Views/partials/footer.php'; }
?>
