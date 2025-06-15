<?php require __DIR__ . '/_form.php';
lineForm($line, $invoice['id'],
  "/?controller=invoiceline&action=update&id={$line['id']}",
  'Editar linha');
