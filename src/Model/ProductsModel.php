<?php

namespace App\Model;

/**
 * Class ProductsModel
 * @package App\Model
 */
class ProductsModel
{
    /**
     * Disponible products
     * 
     * @var array 
     */
    private $products = [
        100 => [
            'id' => 100,
            'name' => 'Darth Vader',
            'description' => 'Fantasia do Darth Vader',
            'price' => 12500,
            'seller' => null
        ],
        101 => [
            'id' => 101,
            'name' => 'Cafú',
            'description' => 'Fantasia do Cafú',
            'price' => 10000,
            'seller' => [
                'id' => 1,
                'name' => 'João Thiago Samuel Cavalcanti',
                'code_split' => 're_cjm5290mz00dgi96d8vx3u277',
                'fee' => 0.85,
                'bank' => [
                    'id' => 2,
                    'code' => 17900015,
                    'bank_code' => '342',
                    'agencia' => '0933',
                    'agencia_dv' => '6',
                    'conta' => '58055',
                    'type' => 'conta_corrente',
                    'conta_dv' => '1',
                    'document_number' => '13562704097',
                    'legal_name' => 'João Thiago Samuel Cavalcanti'
                ]
            ]
        ],
        102 => [
            'id' => 102,
            'name' => 'Máscara de Cavalo',
            'description' => 'Máscara de Cavalo',
            'price' => 15000,
            'seller' => [
                'id' => 2,
                'name' => 'César Anthony João Martins',
                'code_split' => 're_cjm52anxs00d4zp6e4z0h3d3p',
                'fee' => 0.85,
                'bank' => [
                    'id' => 1,
                    'code' => 17900016,
                    'bank_code' => '343',
                    'agencia' => '0934',
                    'agencia_dv' => '7',
                    'conta' => '58056',
                    'type' => 'conta_corrente',
                    'conta_dv' => '1',
                    'document_number' => '68911379000',
                    'legal_name' => 'César Anthony João Martins'
                ]
            ]
        ],
        103 => [
            'id' => 103,
            'name' => 'Máscara de Cavalo 2',
            'description' => 'Máscara de Cavalo 2',
            'price' => 10000,
            'seller' => [
                'id' => 2,
                'name' => 'César Anthony João Martins',
                'code_split' => 're_cjm52anxs00d4zp6e4z0h3d3p',
                'fee' => 0.85,
                'bank' => [
                    'id' => 1,
                    'code' => 17900016,
                    'bank_code' => '343',
                    'agencia' => '0934',
                    'agencia_dv' => '7',
                    'conta' => '58056',
                    'type' => 'conta_corrente',
                    'conta_dv' => '1',
                    'document_number' => '68911379000',
                    'legal_name' => 'César Anthony João Martins'
                ]
            ]
        ],
        104 => [
            'id' => 104,
            'name' => 'Máscara de Pomba',
            'description' => 'Máscara de Pomba',
            'price' => 10000,
            'seller' => [
                'id' => 2,
                'name' => 'César Anthony João Martins',
                'code_split' => 're_cjm52anxs00d4zp6e4z0h3d3p',
                'fee' => 0.85,
                'bank' => [
                    'id' => 1,
                    'code' => 17900016,
                    'bank_code' => '343',
                    'agencia' => '0934',
                    'agencia_dv' => '7',
                    'conta' => '58056',
                    'type' => 'conta_corrente',
                    'conta_dv' => '1',
                    'document_number' => '68911379000',
                    'legal_name' => 'César Anthony João Martins'
                ]
            ]
        ],
        105 => [
            'id' => 105,
            'name' => 'Yoda',
            'description' => 'Fantasia do Yoda',
            'price' => 13000,
            'seller' => null
        ],
    ];

    /**
     * Get all products
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Get product by id
     *
     * @param int $productId Indentify product
     *
     * return array|bool
     */
    public function get($productId)
    {
        if (isset($this->products[$productId])) {
            return $this->products[$productId];
        }

        return false;
    }
}