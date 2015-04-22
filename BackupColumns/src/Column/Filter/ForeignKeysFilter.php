<?php
namespace Column\Filter;

use Column\Filter\AbstractFilter;

class ForeignKeysFilter extends AbstractFilter
{
    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'name',
                'required' => false,
            )
        );
        return $this;
    }
}
