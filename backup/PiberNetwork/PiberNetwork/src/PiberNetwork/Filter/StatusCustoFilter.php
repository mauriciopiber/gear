<?php
namespace PiberNetwork\Filter;

use PiberNetwork\Filter\AbstractFilter;

class StatusCustoFilter extends AbstractFilter
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

        return $this;
    }
}
