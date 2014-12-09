<?php
namespace PiberNetwork\Filter;

use PiberNetwork\Filter\AbstractFilter;

class CustoFilter extends AbstractFilter
{
    public function __construct()
    {

    }

    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'idStatusCusto',
                'required' => false,
                                'validators' => array(
                    $this->getNotEmptyValidator(' Status Custo')
                ),
                            )
        );
        $this->add(
            array(
                'name' => 'idTipoCusto',
                'required' => false,
                                'validators' => array(
                    $this->getNotEmptyValidator(' Tipo Custo')
                ),
                            )
        );
        $this->add(
            array(
                'name' => 'valor',
                'required' => false,
                                'validators' => array(
                    $this->getNotEmptyValidator('Valor')
                ),
                            )
        );
        $this->add(
            array(
                'name' => 'dataCusto',
                'required' => false,
                                'validators' => array(
                    $this->getNotEmptyValidator('Data Custo')
                ),
                            )
        );

        return $this;
    }
}
