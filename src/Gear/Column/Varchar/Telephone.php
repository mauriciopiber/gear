<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;
use Gear\Column\UniqueInterface;

class Telephone extends Varchar implements UniqueInterface
{

    public function filterElement()
    {
        $elementName = $this->str('var', $this->column->getName());
        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                     array(
                        'name' => 'Regex',
                        'options' =>  array(
                            'pattern'   => '/^(\([0-9***REMOVED***{2}\))\s([9***REMOVED***{1})?([0-9***REMOVED***{4})-([0-9***REMOVED***{4})$/',
                            'messages'  => [
                                \Zend\Validator\Regex::INVALID =>'Informe um telefone no formato válido'
                            ***REMOVED***
                        )
                    )
                )
            )
        );

EOS;

        return $element;
    }

    /**
     * Cria um ítem padrão para a Coluna utilizar em assert/select/array
     *
     */
    public function getValueFormat($number)
    {
        return '(51) 9999-99'.sprintf('%02d', $number);
    }

    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value = $this->getValueFormat($numberReference);

        return <<<EOS
                '$name' => '$value',

EOS;
    }


    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $this->getValueFormat($iterator)
        ).PHP_EOL;
    }

    /**
     *
     * @return string
     */
    public function getFixtureDatabase($number)
    {
        return sprintf(
            '%s',
            sprintf('%s%02d', $this->str('var', $this->column->getName()), $number)
        );
    }


    /**
     *
     * @return string
     */
    public function getFixtureFormat($number)
    {
        return sprintf(
            '\'%s\'',
            $this->getValueFormat($number)
        );
    }
}
