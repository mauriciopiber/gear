<?php
namespace Gear\Service\Column\Int;

use Gear\Service\Column\Int;

class Checkbox extends Int
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'int') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        if ($iterator%2==0) {
            $int = 0;
        } else {
            $int = 1;
        }


        return sprintf(
            '                \'%s\' => \'%d\',',
            $this->str('var', $this->column->getName()),
            $int
        ).PHP_EOL;
    }

    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     */
    public function getFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \$this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => '$elementName',
            'options' => array(
                'label' => '$label',
                'use_hidden_element' => true,
                'checked_value' => 'yes',
                'unchecked_value' => 'no'
            ),
            'attributes' => array(
                 'value' => 'yes'
            )
        ));
EOS;
        return $element.PHP_EOL;
    }
}
