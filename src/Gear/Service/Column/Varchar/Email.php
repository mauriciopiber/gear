<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;

class Email extends Varchar
{

    public function getFilterFormElement()
    {
        $elementName = $this->str('var', $this->column->getName());
        $elementLabel = $this->str('label', $this->column->getName());

        $name = '';
        $required = ($this->column->isNullable()) ? 'false' : 'true';


        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    \$this->getEmailAddressValidator('$elementLabel')
                )
            )
        );

EOS;

        return $element;
    }

    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            sprintf('%s%d%s',  $this->str('point', $this->column->getName()), $iterator, '@gmail.com')
        ).PHP_EOL;
    }

    /**
     *
     * @return string
     */
    public function getFixtureFormat($number)
    {
        return sprintf(
            '\'%s\'',
            sprintf('%s%d%s',  $this->str('point', $this->column->getName()), $number, '@gmail.com')
        ).PHP_EOL;
    }
}
