<?php
namespace Gear\Column;

class Varchar extends AbstractColumn
{
    protected $reference;

    public function __construct($column)
    {
        if ($column->getDataType() !== 'varchar') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \'%02d%s\',',
            $this->str('var', $this->column->getName()),
            $iterator,
            $this->str('label', $this->column->getName())
        ).PHP_EOL;
    }


    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $baseMessage = 'insert';
        if (isset($this->reference) && !empty($this->reference)) {
            $baseMessage .= $this->reference;
        }

        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getBaseMessage($baseMessage, $this->column);

        $insert = <<<EOS
            '$columnVar' => '$columnValue',

EOS;
        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertSelectByColumn()
    {
        $baseMessage = 'insert';
        if (isset($this->reference) && !empty($this->reference)) {
            $baseMessage .= $this->reference;
        }

        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getBaseMessage($baseMessage, $this->column);

        $insert = <<<EOS
            '$columnVar' => '$columnValue',

EOS;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de update dos dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumn()
    {
        $baseMessage = 'update';
        if (isset($this->reference) && !empty($this->reference)) {
            $baseMessage .= $this->reference;
        }

        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getBaseMessage($baseMessage, $this->column);

        $update = <<<EOS
            '$columnVar' => '$columnValue',

EOS;
        return $update;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn()
    {
        $baseMessage = 'insert';
        if (isset($this->reference) && !empty($this->reference)) {
            $baseMessage .= $this->reference;
        }

        $columnClass = $this->str('class', $this->column->getName());
        $columnValue = $this->getBaseMessage($baseMessage, $this->column);

        $insertAssert = <<<EOS
        \$this->assertEquals('$columnValue', \$resultSet->get$columnClass());

EOS;
        return $insertAssert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de atualização de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateAssertByColumn()
    {
        $baseMessage = 'update';
        if (isset($this->reference) && !empty($this->reference)) {
            $baseMessage .= $this->reference;
        }

        $columnClass = $this->str('class', $this->column->getName());
        $columnValue = $this->getBaseMessage($baseMessage, $this->column);

        $updateAssert = <<<EOS
        \$this->assertEquals('$columnValue', \$resultSet->get$columnClass());

EOS;
        return $updateAssert;
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
            'type' => 'text',
            'class' => 'form-control'
        ));
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

}
