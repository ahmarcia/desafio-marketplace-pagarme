<?php

namespace App\Model;

/**
 * Class UsersModel
 *
 * @package App\Model
 */
class UsersModel
{
    /**
     * get cart (fake)
     *
     * @return array
     */
    public function getCart()
    {
        return [
            'name' => 'Marcia Lima',
            'email' => 'marciafatima93@hotmail.com',
            'document_number' => '09130141095',
            'address' => [
                'street'        => 'rua teste',
                'street_number' => 2130,
                'neighborhood'  => 'centro',
                'zipcode'       => '01227200',
                'complementary' => 'Apto 143',
                'city'          => 'São Paulo',
                'state'         => 'SP',
                'country'       => 'Brasil'
            ],
            'phone' => [
                'ddd'    => '12',
                'number' => '987523421'
            ],
            'birthday' => '30031993',
            'genre' => 'F',
            'items' => [
                [
                    'id' => 100,
                    'name' => 'Darth Vader',
                    'description' => 'Fantasia do Darth Vader',
                    'price' => 12500,
                    'seller' => [
                        'id' => 1,
                        'name' => 'Maria Barros',
                        'code_split' => 0
                    ]
                ],
                [
                    'id' => 101,
                    'name' => 'Cafú',
                    'description' => 'Fantasia do Cafú',
                    'price' => 10000,
                    'seller' => [
                        'id' => 1,
                        'name' => 'João Thiago Samuel Cavalcanti',
                        'code_split' => 0
                    ]
                ],
                [
                    'id' => 102,
                    'name' => 'Máscara de Cavalo',
                    'description' => 'Máscara de Cavalo',
                    'price' => 15000,
                    'seller' => [
                        'id' => 1,
                        'name' => 'César Anthony João Martins',
                        'code_split' => 0
                    ]
                ]
            ]
        ];
    }
}