<?php
namespace Gear\Filter;

use Zend\InputFilter\InputFilter;

class View extends InputFilter
{
    public function getInputFilter()
    {
        $this->add(
            array(
                'name' => 'target',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                )
            )
        );
        //adicionar validação para targetdir.
        return $this;
    }

}
