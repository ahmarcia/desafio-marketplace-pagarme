<?php

namespace App\Controllers;

use App\Kernel\ControllerAbstract;
use Interop\Container\ContainerInterface;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CartController
 * @package App\Controllers
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
     * List of helpers
     *
     * @var array
     */
    protected $Helpers = [
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

        return $this->render('Cart/index.php', compact('user'));
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
}