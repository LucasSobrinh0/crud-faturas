<?php
# crud-faturas/app/clients/index.php
?>

<!doctype html><html><head>
  <link href="/crud-faturas/public/assets/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
  <h3>Clientes</h3>
  <a href="/crud-faturas/public/clients/create" class="btn btn-primary mb-2">Novo Cliente</a>
  <table class="table table-bordered">
    <thead><tr><th>ID</th><th>Razão Social</th><th>Nome Fantasia</th><th>CNPJ</th></tr></thead>
    <tbody>
      <?php foreach ($clients as $c): ?>
        <tr>
          <td><?= $c['id'] ?></td>
          <td><?= $c['razao_social'] ?></td>
          <td><?= $c['nome_fantasia'] ?></td>
          <td><?= $c['cnpj'] ?></td>
          <td>
            <a href="/crud-faturas/public/clients/edit/<?= $c['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="/crud-faturas/public/clients/delete/<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Del</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body></html>
