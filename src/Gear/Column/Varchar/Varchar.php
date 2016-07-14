<?php
namespace Gear\Column\Varchar;

use Gear\Column\AbstractColumn;

/**
 *
 * Classe que cria colunas para campo texto
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
class Varchar extends AbstractColumn
{
    protected $reference;

    /**
     * @param ColumnObject $column Coluna
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     */
    public function __construct($column)
    {
        if ($column->getDataType() !== 'varchar') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     *
     * @param int $iterator Número base.
     *
     * @return string
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
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
    *
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
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
    *
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
     * Usado nos testes unitários de Repository, Service,
     *  Controller para assert com os dados do array de inserção de dados.
    *
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
            'class' => 'form-control'
        ));
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    /**
     * Retorna a referência da classe
     *
     * @return int
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Seta a referência para classe
     *
     * @param int $reference Número base
     *
     * @return \Gear\Column\Decimal\Decimal
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }
}
