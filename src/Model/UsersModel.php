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
                    'seller' => null
                ],
                [
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
                [
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
                [
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
                ]
            ]
        ];
    }
}