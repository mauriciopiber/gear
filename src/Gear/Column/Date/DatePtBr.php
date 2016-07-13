<?php
namespace Gear\Column\Date;

use Gear\Column\Date\Date;

class DatePtBr extends Date
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'date') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    public function getFixtureDefault($number)
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 01:01:01');
        return $date->format('d/m/Y');
    }

    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value = $this->getFixtureDatabase($numberReference);

        return <<<EOS
                '$name' => '$value',

EOS;
    }

    public function getValue($iterator)
    {
        if ($iterator > 30) {
            $iterator = ($iterator%30);
        }


        $value = sprintf('%02d/%02d/%04d', $iterator, $this->mes, $this->ano);

        return $value;
    }


    /**
     *
     * @return string
     */
    public function getFixtureDatabase($number = null)
    {
        unset($number);
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 01:01:01');
        return $date->format('Y-m-d');
    }

    /**
     * ViewService
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
     * @param array $this->column Colunas válidas.
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
     * @param array $this->column Colunas válidas.
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
