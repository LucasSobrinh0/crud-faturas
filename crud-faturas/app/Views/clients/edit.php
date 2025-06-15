<?php include '../app/Views/partials/header.php'; ?>
<div class="container mt-4">
  <h2>Editar cliente</h2>

  <form action="/?controller=client&action=update&id=<?= $client['id'] ?>" method="POST" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Razão social</label>
      <input type="text" name="razao_social" class="form-control"
             value="<?= htmlspecialchars($client['razao_social']) ?>" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Nome fantasia</label>
      <input type="text" name="nome_fantasia" class="form-control"
             value="<?= htmlspecialchars($client['nome_fantasia']) ?>" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">CNPJ</label>
      <input type="text" name="cnpj" class="form-control"
             value="<?= $client['cnpj'] ?>" required>
    </div>

    <div class="col-12">
      <button class="btn btn-success">Salvar</button>
      <a href="/?controller=client&action=index" class="btn btn-secondary"
      onclick="return confirm('Confirma cancelar?')">Cancelar</a>
    </div>
  </form>
</div>
<?php include '../app/Views/partials/footer.php'; ?>
