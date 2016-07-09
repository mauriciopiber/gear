<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;
use Gear\Column\UniqueInterface;

class Email extends Varchar implements UniqueInterface
{


    public function getFilterFormElement()
    {
        if ($this->getUniqueConstraint() !== false) {
            return $this->filterUniqueElement();
        }
        return $this->filterElement();
    }



    public function filterUniqueElement()
    {
        $elementName = $this->column->getName();
        $elementLabel = $this->str('label', $this->column->getName());

        $elementClass = $this->str('var-lenght', 'id'.$this->str('class', $this->column->getTableName()));

        $tableName  = $this->column->getTableName();
        $tableLabelUnique = $this->str('label', $this->column->getTableName());

        $primaryKey = 'id_'.$this->str('uline', $this->column->getTableName());

        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    \$this->getEmailAddressValidator('$elementLabel'),
                    \$this->getNoRecordExistValidator(
                        '$tableLabelUnique',
                        '$elementLabel',
                        '$tableName',
                        '$elementName',
                        '$primaryKey',
                        \${$elementClass}
                    )
                )
            )
        );

EOS;
        return $element;
    }

    public function filterElement()
    {
        $elementName = $this->str('var', $this->column->getName());
        $elementLabel = $this->str('label', $this->column->getName());

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

    public function getValue()
    {
        return sprintf('%s', $this->str('point', $this->column->getName())).'%02d'.sprintf('%s', '@gmail.com');
    }

    public function getValueFormat($number)
    {
        return sprintf('%s%02d%s', $this->str('point', $this->column->getName()), $number, '@gmail.com');
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
            sprintf('%s%02d%s', $this->str('point', $this->column->getName()), $iterator, '@gmail.com')
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
