<?php

namespace App\Controllers;

use App\Kernel\ControllerAbstract;
use Interop\Container\ContainerInterface;

/**
 * Class CatalogController
 * @package App\Controllers
 *
 * @property \App\Model\ProductsModel;
 */
class CatalogController extends ControllerAbstract
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
    protected $Helpers = [];

    /**
     * Initialize Controller
     *
     * @return void
     */
    public function initialize()
    {
        $this->Products = $this->getContainer()['Products'];

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
        $products = $this->Products->getProducts();

        return $this->render('Catalog/index.php', compact('products'));
    }
}