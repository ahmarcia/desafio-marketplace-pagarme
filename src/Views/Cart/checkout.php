<?php
/**
 * @var PagarMe\Sdk\Transaction\CreditCardTransaction $transaction
 */

$status = [
    'authorized' => 'Pedido autorizado pela administradora do cartão',
    'paid' => 'Pedido aprovado pela administradora do cartão',
    'refused' => 'Pedido recusado'
];

include(__DIR__ . '/../Layout/head.php'); ?>

<div class="container">
    <div class="py-5 text-center">
        <h2>Checkout</h2>
    </div>
    <div class="container">
        <h1 class="jumbotron-heading">Pedido realizado com sucesso!</h1>
        <p class="lead text-muted">id: <?= $transaction->getTid() ?></p>
        <p class="lead text-muted">
            R$ <?= number_format($transaction->getAmount() / 100, 2, ',', '') ?>
        <p class="lead text-muted">status: <?= $status[$transaction->getStatus()] ?></p>
        <p>
            <a href="/catalog" class="btn btn-primary my-2">Catalogo de produtos</a>
        </p>
    </div>
</div>

<?php include(__DIR__ . '/../Layout/footer.php');