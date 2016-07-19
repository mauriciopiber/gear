<?php
namespace Gear\Column\Date;

use Gear\Column\Date\Date;

/**
 *
 * Classe que cria colunas DatePtBr
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
class DatePtBr extends Date
{
    /**
     * @param ColumnObject $column Coluna
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     */
    public function __construct($column)
    {
        if ($column->getDataType() !== 'date') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /**
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string Formato utilizado para Form/View
     */
    public function getValue($iterator)
    {
        $iterator = $this->getValidDay($iterator);

        $month = $this->getValidMonth($iterator);
        $year = $this->getValidYear($iterator);

        $value = sprintf('%02d/%02d/%04d', $iterator, $month, $year);

        return $value;
    }

    /**
     * ViewService
     *
     * @return string
     */
    public function getViewData()
    {
        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->%s->format(\'d/m/Y\')', $this->str('var', $this->column->getName()))
        );
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
    *
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $this->getInsertTime()->format('Y-m-d H:i:s'));

        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $date->format('d/m/Y')
        ).PHP_EOL;

        return $insert;
    }


    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
    *
     * @return string Texto para inserir no template
     */
    public function getInsertSelectByColumn()
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $this->getInsertTime()->format('Y-m-d H:i:s'));

        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => new \DateTime(\'%s\'),',
            $this->str('var', $this->column->getName()),
            $date->format($this->getDateGlobalFormat())
        ).PHP_EOL;

        return $insert;
    }



    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     *
     * @return string
     */
    public function getFormElement()
    {
        $var         = $this->str('var-lenght', $this->column->getName());
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \${$var} = new Element\Date('{$elementName}');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'text',
            'class' => 'form-control date-pt-br'
        ));
        \${$var}->setFormat('d/m/Y');
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    /**
     * {@inheritDoc}
     * @see \Gear\Column\Date\Date::getViewListRowElement()
     *
     * @return string
     */
    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $element = <<<EOS

                         <td>
                             <span ng-bind="{$tableVar}.{$elementName}.date | DatePtBr"></span>
                         </td>

EOS;

        return $element;
    }
}
