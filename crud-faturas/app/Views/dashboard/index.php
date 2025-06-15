<?php include '../app/Views/partials/header.php'; ?>
<h2 class="mb-4">Dashboard</h2>

<div class="row g-4 mb-4">
  <div class="col-md-4">
    <div class="card shadow-sm border-0">
      <div class="card-body text-center">
        <i class="bi bi-people-fill fs-3 text-primary"></i>
        <h5 class="mt-2">Clientes</h5>
        <h3><?= $totClients ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm border-0">
      <div class="card-body text-center">
        <i class="bi bi-receipt fs-3 text-success"></i>
        <h5 class="mt-2">Faturas</h5>
        <h3><?= $totInvoices ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm border-0">
      <div class="card-body text-center">
        <i class="bi bi-currency-dollar fs-3 text-warning"></i>
        <h5 class="mt-2">Valor total</h5>
        <h3>R$ <?= number_format($totValue,2,',','.') ?></h3>
      </div>
    </div>
  </div>
</div>

<!-- Gráfico -->
<div class="card shadow-sm border-0">
  <div class="card-body">
    <h5 class="card-title mb-3">Receita últimos 6 meses</h5>
    <canvas id="chart" height="110"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
const ctx   = document.getElementById('chart');
const data  = {
  labels: <?= json_encode(array_keys($months)) ?>,
  datasets: [{
    label: 'Total (R$)',
    data:  <?= json_encode(array_values($months)) ?>,
    fill: true,
    tension: .3
  }]
};
new Chart(ctx, {type:'line', data});
</script>
<?php include '../app/Views/partials/footer.php'; ?>
