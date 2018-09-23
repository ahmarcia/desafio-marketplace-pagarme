<?php
/**
 * @var PagarMe\Sdk\Transaction\CreditCardTransaction $transaction
 */

include(__DIR__ . '/../Layout/head.php'); ?>

<div class="container">
    <div class="py-5 text-center">
        <h2>Checkout</h2>
    </div>
    <div class="container">
        <h1 class="jumbotron-heading">Ops... algo inesperado ocorreu!</h1>
        <p class="lead text-muted">
            Falha ao finalizar pedido, revise seus dados na página do carrinho e tente novamente.
        </p>
        <p>
            <a href="/catalog" class="btn btn-primary my-2">Catalogo de produtos</a>
            <a href="/cart" class="btn btn-secondary my-2">Revisar carrinho</a>
        </p>
    </div>
</div>

<?php include(__DIR__ . '/../Layout/footer.php');