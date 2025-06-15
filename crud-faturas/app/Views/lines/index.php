<?php include '../app/Views/partials/header.php'; ?>
<?php
function formatPhone(string $n): string
{
    $n = preg_replace('/\D/', '', $n);
    return strlen($n) === 11
        ? sprintf('(%s) %s-%s', substr($n,0,2), substr($n,2,5), substr($n,7))
        : (strlen($n) === 10
            ? sprintf('(%s) %s-%s', substr($n,0,2), substr($n,2,4), substr($n,6))
            : $n);
}
?>
<div class="d-flex justify-content-between align-items-center">
  <h2>Linhas da Fatura #<?= $invoice['id'] ?> — <?= $invoice['reference'] ?></h2>
  <a href="/?controller=invoiceline&action=create&id=<?= $invoice['id'] ?>"
     class="btn btn-primary">+ Nova linha</a>
</div>

<table class="table table-striped mt-3">
  <thead><tr>
    <th>Número</th><th>Valor</th><th>Ações</th>
  </tr></thead>
  <tbody>
  <?php foreach ($lines as $l): ?>
    <tr>
      <td><?= formatPhone($l['line_number']) ?></td>
      <td>R$ <?= number_format($l['line_value'],2,',','.') ?></td>
      <td>
        <a class="btn btn-sm btn-warning"
           href="/?controller=invoiceline&action=edit&id=<?= $l['id'] ?>">Editar</a>
        <a class="btn btn-sm btn-danger"
           href="/?controller=invoiceline&action=delete&id=<?= $l['id'] ?>"
           onclick="return confirm('Excluir linha?')">Excluir</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php include '../app/Views/partials/footer.php'; ?>
