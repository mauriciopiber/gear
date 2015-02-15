<?php
namespace Gear\Service\Column;

class Decimal extends AbstractColumn
{
    protected $reference;

    public function __construct($column)
    {
        if ($column->getDataType() !== 'decimal') {
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
            '                \'%s\' => \'%d.%d\',',
            $this->str('var', $this->column->getName()),
            $iterator,
            $iterator
        ).PHP_EOL;
    }

    public function getFixtureDefault($number)
    {
        return $number.'.'.substr($number, 0, 2);
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


    public function getPrecision()
    {
        if (strlen("".$this->reference) > $this->column->getNumericPrecision()) {
            $precision = substr("".$this->reference, $this->column->getNumericPrecision());
        } else {
            $precision = $this->reference;
        }

        return $precision;
    }

    public function getScale()
    {
        if (strlen("".$this->reference) > $this->column->getNumericScale()) {
            $scale = substr("".$this->reference, $this->column->getNumericScale());
        } else {
            $scale = $this->reference;
        }

        return $scale;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => %s,',
            $this->str('var', $this->column->getName()),
            sprintf('%d.%d', $this->getPrecision(), $this->getScale())
        ).PHP_EOL;

        return $insert;
    }


    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de update dos dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumn()
    {
        $update = '            ';
        $update .= sprintf(
            '\'%s\' => %s,',
            $this->str('var', $this->column->getName()),
            sprintf('%d.%d', $this->getPrecision(), $this->getScale())
        ).PHP_EOL;
        return $update;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn()
    {
        $insertAssert = '        ';
        $insertAssert .= sprintf(
            '$this->assertEquals(%s, $resultSet->get%s());',
            sprintf('%d.%d', $this->getPrecision(), $this->getScale()),
            $this->str('class', $this->column->getName())
        ).PHP_EOL;

        return $insertAssert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de atualização de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateAssertByColumn()
    {
        $updateAssert = '        ';
        $updateAssert .= sprintf(
            '$this->assertEquals(%s, $resultSet->get%s());',
            sprintf('%d.%d', $this->getPrecision(), $this->getScale()),
            $this->str('class', $this->column->getName())
        ).PHP_EOL;
        return $updateAssert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertSelectByColumn()
    {
        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => %s,',
            $this->str('var', $this->column->getName()),
            sprintf('%d.%d', $this->getPrecision(), $this->getScale())
        ).PHP_EOL;

        return $insert;
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
            'class' => 'form-control decimal'
        ));
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }


}
