<?php
namespace Gear\Column\Decimal;

use Gear\Column\Decimal;

class MoneyPtBr extends Decimal
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'decimal') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     */
    public function getViewData()
    {
        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->currencyFormat($this->%s)', $this->str('var', $this->column->getName()))
        );
    }


    public function getFixtureDefault($number)
    {
        return 'R$ '.$number.','.substr($number, 0, 2);
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
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
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de update dos dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumn()
    {
        $update = '            ';
        $update .= sprintf(
            '\'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            sprintf('R$ %d,%d', $this->getPrecision(), $this->getScale())
        ).PHP_EOL;
        return $update;
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

/*     public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        <td>
            <?php echo \$this->escapeHtml(\$this->currencyFormat(\$this->$elementName)); ?>
        </td>

EOS;

        return $element;
    } */

    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $element = <<<EOS

                         <td>
                             <span ng-bind="{$tableVar}.{$elementName} | currency"></span>
                         </td>

EOS;
        return $element;
    }

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
