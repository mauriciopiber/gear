<?php
namespace PiberNetwork\Filter;

use PiberNetwork\Filter\AbstractFilter;

class TipoCustoFilter extends AbstractFilter
{
    public function __construct()
    {

    }

    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'idGrupoCusto',
                'required' => true,
                                'validators' => array(
                    $this->getNotEmptyValidator(' Gropo Custo')
                ),
                            )
        );
        $this->add(
            array(
                'name' => 'nome',
                'required' => false,
                                'validators' => array(
                    $this->getNotEmptyValidator('Nome')
                ),
                            )
        );

        return $this;
    }
}
