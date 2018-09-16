<?php
/**
 * @var PagarMe\Sdk\Transaction\CreditCardTransaction $transaction
 */

echo 'id: ' . $transaction->getTid() . '<br/>';
echo 'status: ' . $transaction->getStatus() . '<br/>';
echo 'code: ' . $transaction->getAuthorizationCode() . '<br/>';