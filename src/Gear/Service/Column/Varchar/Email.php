<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;
use Gear\Service\Column\UniqueInterface;

class Email extends Varchar implements UniqueInterface
{
    protected $uniqueConstraint;

    public function setUniqueConstraint($uniqueConstraint)
    {
        $this->uniqueConstraint = $uniqueConstraint;
        return $this;
    }

    public function getUniqueConstraint()
    {
        return $this->uniqueConstraint;
    }

    public function getFilterFormElement()
    {
        if ($this->getUniqueConstraint() !== null) {
            return $this->filterUniqueElement();
        }
        return $this->filterElement();

    }

    public function filterUniqueElement()
    {
        $elementName = $this->column->getName();
        $elementLabel = $this->str('label', $this->column->getName());

        $elementClass = $this->str('class', $this->column->getTableName());

        $tableName  = $this->column->getTableName();
        $tableLabel = $this->str('label', $this->column->getTableName());

        $primaryKey = 'id_'.$this->str('uline', $this->column->getTableName());

        $name = '';
        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    \$this->getEmailAddressValidator('$elementLabel'),
                    \$this->getNoRecordExistValidator('$tableLabel', '$elementLabel', '$tableName', '$elementName', \$id{$elementClass}, '$primaryKey')
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
