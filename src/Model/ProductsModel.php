<?php

namespace App\Model;

/**
 * Class ProductsModel
 * @package App\Model
 */
class ProductsModel
{
    /**
     * Available products
     * 
     * @var array 
     */
    private $products = [
        100 => [
            'id' => 100,
            'name' => 'Darth Vader',
            'description' => 'Fantasia do Darth Vader',
            'price' => 12500,
            'seller_id' => null
        ],
        101 => [
            'id' => 101,
            'name' => 'Cafú',
            'description' => 'Fantasia do Cafú',
            'price' => 10000,
            'seller_id' => 1
        ],
        102 => [
            'id' => 102,
            'name' => 'Máscara de Cavalo',
            'description' => 'Máscara de Cavalo',
            'price' => 15000,
            'seller_id' => 2
        ],
        103 => [
            'id' => 103,
            'name' => 'Máscara de Cavalo 2',
            'description' => 'Máscara de Cavalo 2',
            'price' => 10000,
            'seller_id' => 2
        ],
        104 => [
            'id' => 104,
            'name' => 'Máscara de Pomba',
            'description' => 'Máscara de Pomba',
            'price' => 10000,
            'seller_id' => 2
        ],
        105 => [
            'id' => 105,
            'name' => 'Yoda',
            'description' => 'Fantasia do Yoda',
            'price' => 13000,
            'seller_id' => null
        ],
    ];

    /**
     * @var \App\Model\SellersModel
     */
    private $sellers;

    /**
     * Get all products
     *
     * @return array
     */
    public function getProducts()
    {
        $products = $this->products;

        foreach ($products as $key => $product) {
            $products[$key]['seller'] = $this->sellers->get($product['seller_id']);
        }

        return $products;
    }

    /**
     * Get product by id
     *
     * @param int $id Identify product
     *
     * @return array|bool
     */
    public function get($id)
    {
        if (isset($this->products[$id])) {
            $this->products[$id]['seller'] = $this->sellers->get($this->products[$id]['seller_id']);

            return $this->products[$id];
        }

        return false;
    }

    /**
     * Get Sellers model
     *
     * @return \App\Model\SellersModel
     */
    public function getSellers()
    {
        return $this->sellers;
    }

    /**
     * Set Sellers model
     *
     * @param \App\Model\SellersModel $sellers
     *
     * @return void
     */
    public function setSellers($sellers)
    {
        $this->sellers = $sellers;
    }
}