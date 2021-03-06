<?php
/**
 * Created by PhpStorm.
 * User: marcialima
 * Date: 2018-09-15
 * Time: 20:42
 */

namespace App\Helpers;

use PagarMe\Sdk\ClientException;
use \PagarMe\Sdk\Customer\Customer;
use \PagarMe\Sdk\SplitRule\SplitRuleCollection;

class CheckoutHelper
{
    const SHIPPING = 4200;

    /**
     * @var \PagarMe\Sdk\PagarMe
     */
    protected $PagarMe;

    /**
     * @var \Monolog\Logger
     */
    protected $logger;

    /**
     * Get marketplace recipient
     *
     * @var string
     */
    protected $recipient;

    /**
     * CheckoutHelper constructor.
     * 
     * @param $gateway
     */
    public function __construct($gateway, $logger, $recipient)
    {
        $this->PagarMe = $gateway;
        $this->logger = $logger;
        $this->recipient = $recipient;
    }

    /**
     * Define transaction
     *
     * @todo obter opção de capturar o valor do pagamento do arquivo de configuração
     *
     * @param array $user User and cart data
     * @param array $card Data payment card
     *
     * @return \PagarMe\Sdk\Transaction\CreditCardTransaction|false
     */
    public function getTransaction($user, $card)
    {
        $amount = 0;
        $splitRule = $this->getSplitRules($user['cart'], $amount);

        try {
            return $transaction = $this->PagarMe->transaction()->creditCardTransaction(
                $amount,
                $this->createCard($card),
                $this->createCustumer($user),
                1,
                true,
                null,
                $this->defineMetadata($user['cart']),
                [
                    'async' => false,
                    'split_rules' => $splitRule
                ]
            );
        } catch (ClientException $exception) {
            $this->logger->debug('Transaction fail ' . $exception->getMessage(), $exception->getTrace());

            return false;
        }
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
            $card['expiration'],
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
        $shipping = self::SHIPPING;
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

        $amount += $amountMarketplace;
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

        return $splitRules;
    }

    /**
     * Get marketplace recipient
     *
     * @return \PagarMe\Sdk\Recipient\Recipient
     */
    private function getMarketplaceRecipient()
    {
        return $this->PagarMe->recipient()->get($this->recipient);
    }

    /**
     * Get seller items cart
     *
     * @param array $items  Items user cart
     * @param int   $amount Value user cart
     *
     * @return array
     */
    public function getItemsSeller($items, &$amount)
    {
        $itemsSellers = [];
        foreach ($items as $item) {
            if (is_array($item['seller']) && isset($item['seller']['id'])) {
                if (!isset($itemsSellers[$item['seller']['id']])) {
                    $amount += self::SHIPPING;
                }
                $itemsSellers[$item['seller']['id']][] = $item;
                $amount += $item['price'];
            }
        }

        return $itemsSellers;
    }

    /**
     * get marketplace items cart
     *
     * @param array $items  Items user cart
     * @param int   $amount Value user cart
     *
     * @return array
     */
    public function getItemsMarketplace($items, &$amount)
    {
        $itemsMarketplace = [];
        foreach ($items as $item) {
            if (!is_array($item['seller']) || !isset($item['seller']['id'])) {
                $itemsMarketplace[] = $item;
                $amount += $item['price'];
            }
        }

        if (count($itemsMarketplace) > 0) {
            $amount += self::SHIPPING;
        }

        return $itemsMarketplace;
    }
}