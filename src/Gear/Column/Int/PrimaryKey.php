<?php
namespace Gear\Column\Int;

use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\Int;

class PrimaryKey extends Int
{
    public function __construct(ColumnObject $column, ConstraintObject $constraint)
    {
        if ($column->getDataType() !== 'int') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }

        if (
            $constraint->getType() !== 'PRIMARY KEY'
            || !in_array($column->getName(), $constraint->getColumns())
        ) {
            throw new \Gear\Exception\InvalidForeignKeyException();
        }


        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     */
    public function getViewData()
    {
        return $this->getViewColumnLayout(
            'ID',
            sprintf('$this->%s', $this->str('var', $this->column->getName()))
        );
    }

    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     */
    public function getFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());;


        $element = <<<EOS
        \${$var} = new Element('$elementName');
        \${$var}->setLabel('$label');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'hidden',
        ));
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }
}
