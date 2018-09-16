<?php
/**
 * Created by PhpStorm.
 * User: marcialima
 * Date: 2018-09-15
 * Time: 20:42
 */

namespace App\Helpers;

use \PagarMe\Sdk\Customer\Customer;
use \PagarMe\Sdk\SplitRule\SplitRuleCollection;

class CheckoutHelper
{
    /**
     * @var \PagarMe\Sdk\PagarMe
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
     * @todo obter opção de capturar o valor do pagamento do arquivo de configuração
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
            true,
            null,
            $this->defineMetadata($cart['items']),
            [
                'async' => false,
                'split_rules' => $this->getSplitRules($cart['items'])
            ]
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
            $metadata[] = [
                'id' => $item['id'],
                'name' => $item['name']
            ];
        }

        return json_encode($metadata);
    }

    /**
     * Get split rules
     *
     * @param array $items List items cart
     *
     * @return array|SplitRuleCollection
     */
    private function getSplitRules($items)
    {
        $splitRules = new SplitRuleCollection();
        $amountMartplace = 0;

        foreach ($items as $item) {
            if (isset($item['seller'])) {
                $recipient = $this->PagarMe->recipient()->get($item['seller']['code_split']);
                $value = $item['price'] * $item['seller']['fee'];
                $amountMartplace += $item['price'] - $value;

                $splitRules[] = $this->PagarMe->splitRule()->monetaryRule(
                    $value,
                    $recipient,
                    false,
                    true
                );
            } else {
                $amountMartplace += $item['price'];
            }
        }

        if ($splitRules->count() == 0) {
            return null;
        }

        $splitRules[] = $this->PagarMe->splitRule()->monetaryRule(
            $amountMartplace,
            $this->getMarketplaceRecipient(),
            true,
            true
        );

        return $splitRules;
    }

    /**
     * Get marketplace recient
     *
     * @todo obter a identificação da conta do arquivo de configuração
     *
     * @return \PagarMe\Sdk\Recipient\Recipient
     */
    private function getMarketplaceRecipient()
    {
        return $this->PagarMe->recipient()->get('re_cjlv2wcqt00ei3o6d9qeqhgl5');
    }
}