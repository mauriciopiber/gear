<?php
namespace PiberNetwork\Filter;

use PiberNetwork\Filter\AbstractFilter;

class TipoServicoFilter extends AbstractFilter
{
    public function __construct()
    {

    }

    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'nome',
                'required' => false,
                                'validators' => array(
                    $this->getNotEmptyValidator('Nome')
                ),
                            )
        );
        $this->add(
            array(
                'name' => 'descricao',
                'required' => false,
                                'validators' => array(
                    $this->getNotEmptyValidator('Descricao')
                ),
                            )
        );

        return $this;
    }
}
