<?php include '../app/Views/partials/header.php'; ?>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center">
    <h2>Clientes</h2>
    <a href="/?controller=client&action=create" class="btn btn-primary">+ Novo</a>
  </div>
  <form class="row g-2 mb-3" method="GET" action="?">
  <input type="hidden" name="controller" value="client">
  <input type="hidden" name="action"     value="index">

  <div class="col-md-6 col-sm-8">
    <input type="text" name="q"
           value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
           class="form-control"
           placeholder="Buscar por ID, Razão social, Nome fantasia ou CNPJ">
  </div>
  <div class="col-md-2 col-sm-4 d-grid">
    <button class="btn btn-primary">Buscar</button>
  </div>
</form>
  <table class="table table-striped mt-3">
    <thead>
      <tr>
        <th>ID</th><th>Razão social</th><th>Nome fantasia</th><th>CNPJ</th><th>Ações</th>
      </tr>
    </thead>
    <tbody id="client-body">
      <?php foreach ($clients as $c): ?>
      <tr>
        <td><?= $c['id'] ?></td>
        <td><?= htmlspecialchars($c['razao_social']) ?></td>
        <td><?= htmlspecialchars($c['nome_fantasia']) ?></td>
        <td><?= preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $c['cnpj']) ?></td>
        <td>
          <a class="btn btn-outline-primary" href="/?controller=client&action=edit&id=<?= $c['id'] ?>">Editar</a>
          <a class="btn btn-outline-danger"  href="/?controller=client&action=delete&id=<?= $c['id'] ?>" 
             onclick="return confirm('Confirma excluir?')">Excluir</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include '../app/Views/partials/footer.php'; ?>
