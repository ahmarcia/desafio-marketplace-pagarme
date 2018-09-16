<?php
/**
 * Created by PhpStorm.
 * User: marcialima
 * Date: 2018-09-15
 * Time: 20:42
 */

namespace App\Helpers;

use \PagarMe\Sdk\Customer\Customer;
use PagarMe\Sdk\PagarMe;

class CheckoutHelper
{
    /**
     * @var PagarMe
     */
    protected $PagarMe;

    /**
     * CheckoutHelper constructor.
     * 
     * @param $gateway
     */
    public function __construct($gateway)
    {
        $this->PagarMe = $gateway;
    }

    /**
     * Define transaction
     *
     * @param array $cart User and cart data
     * @param array $card Data payment card
     *
     * @return \PagarMe\Sdk\Transaction\CreditCardTransaction
     */
    public function getTransaction($cart, $card)
    {
        return $this->PagarMe->transaction()->creditCardTransaction(
            $this->getAmount($cart['items']),
            $this->createCard($card),
            $this->createCustumer($cart),
            $card['installments'],
            true, // obter opção de capturar o valor do pagamento do arquivo de configuração
            null,
            $this->defineMetadata($cart['items']),
            [ 'async' => false ]
        );
    }

    /**
     * Get amount cart
     *
     * @param array $items List items cart
     *
     * @return int
     */
    private function getAmount($items)
    {
        $amount  = 0;

        foreach ($items as $item) {
            $amount += $item['price'];
        }

        return $amount;
    }

    /**
     * Create card
     *
     * @param array $card Data payment card
     *
     * @return \PagarMe\Sdk\Card\Card
     */
    private function createCard($card)
    {
        return $this->PagarMe->card()->create(
            $card['number'],
            $card['name'],
            $card['cvv']
        );
    }

    /**
     * Create User
     *
     * @param array $user Data user
     *
     * @return Customer
     */
    private function createCustumer($user)
    {
        return new Customer([
            'name' => $user['name'],
            'email' => $user['email'],
            'document_number' => $user['document_number'],
            'address' => $user['address'],
            'phone' => $user['phone'],
            'born_at' => $user['birthday'],
            'sex' => $user['genre']
        ]);
    }

    /**
     * Define metadata, info items cart
     *
     * @param array $items List items cart
     *
     * @return false|string
     */
    private function defineMetadata($items)
    {
        $metadata = [];

        foreach ($items as $item) {
            $metadata[$item['id']] = $item['name'];
        }

        return json_encode($metadata);
    }
}