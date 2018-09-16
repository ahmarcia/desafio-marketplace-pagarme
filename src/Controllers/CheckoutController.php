<?php

namespace App\Controllers;

use App\Kernel\ControllerAbstract;
use Interop\Container\ContainerInterface;

/**
 * Class CheckoutController
 * @package App\Controllers
 *
 * @property \App\Helpers\CheckoutHelper $checkoutHelp
 */
class CheckoutController extends ControllerAbstract
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->initialize();
    }

    /**
     * SDK pagar.me
     *
     * @var \PagarMe\Sdk\PagarMe
     */
    protected $PagarMe;

    /**
     * Model Users
     *
     * @var \App\Model\UsersModel;
     */
    protected $Users;

    /**
     * List of helpers
     *
     * @var array
     */
    protected $Helpers = [
        'checkoutHelp'
    ];

    /**
     * Initialize Controller
     *
     * @return void
     */
    public function initialize()
    {
        $this->PagarMe = $this->getContainer()->pagarme;
        $this->Users = $this->getContainer()->Users;

        foreach ($this->Helpers as $helper) {
            $this->{$helper} = $this->getContainer()->{$helper};
        }
    }

    /**
     * Index Action
     *
     * @return string
     */
    public function index()
    {
        $card = [
            'number' => '4242424242424242',
            'name' => 'Marcia Lima',
            'cvv' => '0722',
            'installments' => 1
        ];
        $cart = $this->Users->getCart();
        $transaction = $this->checkoutHelp->getTransaction($cart, $card);

        return $this->render('Checkout/index.php', ['transaction' => $transaction]);
    }
}
