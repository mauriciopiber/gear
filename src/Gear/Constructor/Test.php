<?php
namespace Gear\Filter;

use Zend\InputFilter\InputFilter;

class Test extends InputFilter
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
                ),
                'validators' => array()
            )
        );
        //adicionar validação para pasta.
        //adicionar validação para suite.
        //adicionar validação para targetdir.
        return $this;
    }
}
