<?php
# crud-faturas/app/clients/edit.php
?>

<!doctype html><html><head>
  <link href="/crud-faturas/public/assets/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
  <h3>Novo Cliente</h3>
  <form action="/crud-faturas/public/clients/store" method="post">
    <div class="mb-2">
      <label>Razão Social</label>
      <input name="razao_social" class="form-control" required>
    </div>
    <div class="mb-2">
      <label>Nome Fantasia</label>
      <input name="nome_fantasia" class="form-control" required>
    </div>
    <div class="mb-2">
      <label>CNPJ</label>
      <input name="cnpj" class="form-control" required>
    </div>
    <tbody>
    <td>
  <a href="/crud-faturas/public/clients/edit/<?= $c['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
  <a href="/crud-faturas/public/clients/delete/<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Del</a>
</td>
    </tbody>
    <button class="btn btn-success">Salvar</button>
    <a href="/crud-faturas/public/clients" class="btn btn-secondary">Cancelar</a>
  </form>
</body></html>
