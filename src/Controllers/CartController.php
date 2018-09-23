<?php

namespace App\Controllers;

use App\Kernel\ControllerAbstract;
use Interop\Container\ContainerInterface;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CartController
 * @package App\Controllers
 *
 * @property \App\Helpers\Session $session
 * @property \App\Helpers\Request requestHelp
 * @property \App\Helpers\CheckoutHelper $checkoutHelp
 */
class CartController extends ControllerAbstract
{
    /**
     * CheckoutController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->initialize();
    }

    /**
     * Product Model
     *
     * @var \App\Model\ProductsModel;
     */
    protected $Products;

    /**
     * SDK pagar.me
     *
     * @var \PagarMe\Sdk\PagarMe
     */
    protected $PagarMe;

    /**
     * List of helpers
     *
     * @var array
     */
    protected $Helpers = [
        'checkoutHelp',
        'requestHelp',
        'session'
    ];

    /**
     * Initialize Controller
     *
     * @return void
     */
    public function initialize()
    {
        $this->Products = $this->getContainer()->Products;
        $this->PagarMe = $this->getContainer()->pagarme;

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
        $user = $this->session->getAuth('User');
        $amount = 0;
        $shipping = 4500;
        $user['marketplace'] = $this->checkoutHelp->getItemsMarketplace($user['cart'], $amount);
        $user['seller'] = $this->checkoutHelp->getItemsSeller($user['cart'], $amount);

        return $this->render('Cart/index.php', compact('user', 'shipping', 'amount'));
    }

    /**
     * Add action
     *
     * @return string
     */
    public function add(Request $request, Response $response, array $args)
    {
        $user = $this->session->getAuth('User');

        if (!array_key_exists($args['id'], $user['cart'])) {
            $product = $this->Products->get($args['id']);

            if ($product) {
                $user['cart'][$args['id']] = $product;
            }
        }
        $this->session->set('User', $user);

        return $response->withRedirect('/cart', 200);
    }

    /**
     * Index Action
     *
     * @return string
     */
    public function checkout()
    {
        $card = $this->requestHelp->getData('card');
        $user = $this->requestHelp->getData('user');
        $user['cart'] = $this->session->getAuth()['cart'];
        
        $transaction = $this->checkoutHelp->getTransaction($user, $card);

        $user['cart'] = [];
        $this->session->set('User', $user);

        return $this->render('cart/checkout.php', ['transaction' => $transaction]);
    }
}