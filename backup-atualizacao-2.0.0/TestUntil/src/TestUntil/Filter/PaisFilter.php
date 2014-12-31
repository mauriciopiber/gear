<?php
namespace TestUntil\Filter;

use TestUntil\Filter\AbstractFilter;

class PaisFilter extends AbstractFilter
{
    public function __construct()
    {

    }

    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'nome',
                'required' => true,
                'validators' => array(
                    $this->getNotEmptyValidator('Nome')
                ),
            )
        );

        return $this;
    }
}
