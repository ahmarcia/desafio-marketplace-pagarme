<?php

namespace App\Model;

/**
 * Class SellersModel
 * @package App\Model
 */
class SellersModel
{
    /**
     * Code split PagarMe
     *
     * @var array
     */
    private $codesSplit;

    /**
     * Disponible products
     * 
     * @var array 
     */
    private $sellers = [
        1 => [
            'id' => 1,
            'name' => 'João Thiago Samuel Cavalcanti',
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
        ],
        2 => [
            'id' => 2,
            'name' => 'César Anthony João Martins',
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
    ];

    /**
     * Get all sellers
     *
     * @return array
     */
    public function getSellers()
    {
        return $this->sellers;
    }

    /**
     * Get seller by id
     *
     * @param int $id Identify seller
     *
     * @return array|null
     */
    public function get($id)
    {
        if (isset($this->sellers[$id])) {
            $seller = $this->sellers[$id];
            $seller['code_split'] = $this->getCodeSplit($id);

            return $seller;
        }

        return null;
    }

    /**
     * Set codes split PagarMe
     *
     * @param array $codesSplit
     *
     * @return void
     */
    public function setCodesSplit($codesSplit)
    {
        $this->codesSplit = $codesSplit;
    }

    /**
     * Get code split seller
     *
     * @param int $id Identify seller
     *
     * @return string
     */
    private function getCodeSplit($id)
    {
        if (isset($this->codesSplit[$id])) {
            return $this->codesSplit[$id];
        }

        return '';
    }
}