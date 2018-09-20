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
     * get User (fake)
     *
     * @return array
     */
    public function get($id = null)
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
            'genre' => 'F'
        ];
    }
}