<?php
namespace Gear\Service\Column;

class Datetime extends AbstractDateTime
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'datetime') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }


    public function getFixtureDefault($number)
    {
        return date('Y-m-d H:i:s');
    }

    public function getFixtureDefaultDb($number)
    {
        return date('Y-m-d H:i:s');
    }


    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        $dia = $iterator;
        $mes = 12;
        $ano = 2020;

        if ($iterator > 23) {
            $hora = 30 - $iterator;
        } else {
            $hora = $iterator;
        }

        $minuto = 0;
        $segundo = 2;

        $time = sprintf('%04d-%02d-%02d %02d:%02d:%02d', $ano, $mes, $dia , $hora, $minuto, $segundo);

        return sprintf(
            '                \'%s\' => \DateTime::createFromFormat(\'Y-m-d H:i:s\', \'%s\'),',
            $this->str('var', $this->column->getName()),
            $time
        ).PHP_EOL;
    }

    /**
     * Função usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     */
    public function getViewData()
    {
        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->%s->format(\'Y-m-d H:i:s\')', $this->str('var', $this->column->getName()))
        );
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $date = \DateTime::createFromFormat($this->getDateTimeGlobalFormat(), $this->getInsertTime()->format($this->getDateTimeGlobalFormat()));

        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $date->format($this->getDateTimeGlobalFormat())
        ).PHP_EOL;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertSelectByColumn()
    {
        $date = \DateTime::createFromFormat($this->getDateTimeGlobalFormat(), $this->getInsertTime()->format($this->getDateTimeGlobalFormat()));

        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => new \DateTime(\'%s\'),',
            $this->str('var', $this->column->getName()),
            $date->format($this->getDateTimeGlobalFormat())
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
        $date = \DateTime::createFromFormat($this->getDateTimeGlobalFormat(), $this->getUpdateTime()->format($this->getDateTimeGlobalFormat()));

        $update = '            ';
        $update .= sprintf(
            '\'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $date->format($this->getDateTimeGlobalFormat())
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
        $date = \DateTime::createFromFormat($this->getDateTimeGlobalFormat(), $this->getInsertTime()->format($this->getDateTimeGlobalFormat()));


        $insertAssert = '        ';
        $insertAssert .= sprintf(
            '$this->assertEquals(\'%s\', $resultSet->get%s()->format(\'%s\'));',
            $date->format($this->getDateTimeGlobalFormat()),
            $this->str('class', $this->column->getName()),
            $this->getDateTimeGlobalFormat()
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
        $date = \DateTime::createFromFormat($this->getDateTimeGlobalFormat(), $this->getUpdateTime()->format($this->getDateTimeGlobalFormat()));

        $updateAssert = '        ';
        $updateAssert .= sprintf(
            '$this->assertEquals(\'%s\', $resultSet->get%s()->format(\'%s\'));',
            $date->format($this->getDateTimeGlobalFormat()),
            $this->str('class', $this->column->getName()),
            $this->getDateTimeGlobalFormat()
        ).PHP_EOL;

        return $updateAssert;
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
        \${$var} = new Element\DateTime('{$elementName}');
        \${$var}->setAttributes(array(
            'name' => '{$elementName}',
            'id' => '{$elementName}',
            'type' => 'datetime',
            'step' => 'any',
            'class' => 'form-control datetime'
        ));
        \${$var}->setFormat('Y-m-d H:i:s');
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

}
