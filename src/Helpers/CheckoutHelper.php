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
        $amount = 0;
        $splitRule = $this->getSplitRules($cart['cart'], $amount);
        
        return $this->PagarMe->transaction()->creditCardTransaction(
            $amount,
            $this->createCard($card),
            $this->createCustumer($cart),
            $card['installments'],
            true,
            null,
            $this->defineMetadata($cart['cart']),
            [
                'async' => false,
                'split_rules' => $splitRule
            ]
        );
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
    private function getSplitRules($items, &$amount)
    {
        $shipping = 4500;
        $itemsSellers = [];
        $amountMarketplace = 0;
        $marketplaceItem = false;
        
        foreach ($items as $item) {
            if (isset($item['seller']) && !is_null($item['seller'])) {
                $sellerId = $item['seller']['id'];
                $value = $item['price'] * $item['seller']['fee'];
                $amountMarketplace += $item['price'] - $value;

                if (array_key_exists($sellerId, $itemsSellers))  {
                    $itemsSellers[$sellerId]['amount'] += $value;
                } else {
                    $itemsSellers[$sellerId] =[
                        'amount' => $value + $shipping,
                        'code_split' => $item['seller']['code_split']
                    ];
                }
            } else {
                $amountMarketplace += $item['price'];
                if (!$marketplaceItem) {
                    $amountMarketplace += $shipping;
                    $marketplaceItem = true;
                }
            }
        }

        if (empty($itemsSellers)) {
            return null;
        }

        $splitRules = new SplitRuleCollection();
        foreach ($itemsSellers as $seller) {
            $recipient = $this->PagarMe->recipient()->get($seller['code_split']);
            $amount += $seller['amount'];

            $splitRules[] = $this->PagarMe->splitRule()->monetaryRule(
                $seller['amount'],
                $recipient,
                false,
                true
            );
        }

        $splitRules[] = $this->PagarMe->splitRule()->monetaryRule(
            $amountMarketplace,
            $this->getMarketplaceRecipient(),
            true,
            true
        );
        $amount += $amountMarketplace;

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