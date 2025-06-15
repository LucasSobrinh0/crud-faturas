<?php
require __DIR__ . '/_form.php';
invoiceForm(
    $invoice,               // dados da fatura
    $clients,
    "/?controller=invoice&action=update&id={$invoice['id']}",
    'Editar fatura'
);
