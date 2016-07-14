<?php
namespace Gear\Column\Int;

use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\Int\Int;

/**
 *
 * Classe que cria colunas int na Primary Key.
 *
 * @category   Column
 * @package    Gear
 * @subpackage Column
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */
class PrimaryKey extends Int
{
    /**
     * @param ColumnObject     $column     Coluna
     * @param ConstraintObject $constraint PrimaryKey
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     */
    public function __construct(ColumnObject $column, ConstraintObject $constraint)
    {
        if ($column->getDataType() !== 'int') {
            throw new \Gear\Exception\InvalidDataTypeColumnException($column->getDataType());
        }

        if ($constraint->getType() !== 'PRIMARY KEY'
            || !in_array($column->getName(), $constraint->getColumns())
        ) {
            throw new \Gear\Exception\InvalidForeignKeyException();
        }


        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     *
     * @return string
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
     *
     * @return string
     */
    public function getFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());


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
