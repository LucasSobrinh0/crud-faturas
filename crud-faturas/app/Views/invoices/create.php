<?php
require __DIR__ . '/_form.php';
invoiceForm(
    [],                     // não há dados ainda
    $clients,               // lista de clientes vinda do controller
    '/?controller=invoice&action=store',
    'Nova fatura'
);
