<?php
namespace Gear\Column\Decimal;

use Gear\Column\Decimal\Decimal;

/**
 *
 * Classe que trabalha com as colunas decimais com o formato de dinheiro pt-br
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
class MoneyPtBr extends Decimal
{
    /**
     * @param ColumnObject $column Coluna
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     */
    public function __construct($column)
    {
        if ($column->getDataType() !== 'decimal') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
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
            $this->str('label', $this->column->getName()),
            sprintf('$this->currencyFormat($this->%s)', $this->str('var', $this->column->getName()))
        );
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
       return sprintf('R$ %d,%02d', $iterator, substr($iterator, 0, 2));
    }

    /*
    public function getFixtureDefault($number)
    {
        return 'R$ '.$number.','.substr($number, 0, 2);
    }
    */

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
    *
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            sprintf('R$ %d,%d', $this->getPrecision(), $this->getScale())
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
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \${$var} = new Element('$elementName');
        \${$var}->setLabel('$label');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'text',
            'class' => 'form-control money'
        ));
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    /**
     * Gera o código para ser usado na listagem em Gear\Mvc\View\ViewService
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getViewListRowElement()
     *
     * @return string
     */
    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $element = <<<EOS

                         <td>
                             <span ng-bind="{$tableVar}.{$elementName} | currency: 'R$ '"></span>
                         </td>

EOS;
        return $element;
    }

    /**
     * Gera o código para ser usado no Form em Gear\Mvc\Search\SearchService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Decimal\Decimal::getSearchFormElement()
     *
     * @return string
     */
    public function getSearchFormElement()
    {

        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \${$var}Pre = new Element('{$elementName}Pre');
        \${$var}Pre->setAttributes(array(
            'name' => '{$elementName}Pre',
            'id' => '{$elementName}Pre',
            'type' => 'text',
            'class' => 'form-control money'
        ));
        \${$var}Pre->setLabel('$label de');
        \$this->add(\${$var}Pre);

        \${$var}Pos = new Element('{$elementName}Pos');
        \${$var}Pos->setAttributes(array(
            'name' => '{$elementName}Pos',
            'id' => '{$elementName}Pos',
            'type' => 'text',
            'class' => 'form-control money'
        ));
        \${$var}Pos->setLabel('até');
        \$this->add(\${$var}Pos);

EOS;
        return $element;
    }
}
