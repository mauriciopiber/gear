<?php
namespace Gear\Column\Decimal;

use Gear\Column\AbstractColumn;
use Gear\Column\Mvc\SearchFormInterface;

/**
 *
 * Classe que trabalha com os valores decimais.
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
class Decimal extends AbstractColumn implements SearchFormInterface
{
    protected $reference;

    /**
     * Cria a coluna Decimal
     *
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
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     *
     * @param int $iterator Número base.
     *
     * @return string Formato utilizado para Form/View
     */
    public function getValue($iterator)
    {
       return sprintf('%d.', $iterator).'%d';
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
            '                \'%s\' => \'%d.%d\',',
            $this->str('var', $this->column->getName()),
            $iterator,
            $iterator
        ).PHP_EOL;
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


    /**
     * Cria a Precisão da classe.
     *
     * @return string|int
     */
    public function getPrecision()
    {
        if (strlen("".$this->reference) > $this->column->getNumericPrecision()) {
            $precision = substr("".$this->reference, $this->column->getNumericPrecision());
        } else {
            $precision = $this->reference;
        }

        return $precision;
    }

    /**
     * Cria a escala da classe
     *
     * @return string|int
     */
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
     *
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
     * Usado nos testes unitários de Repository, Service, Controller para
     * assert com os dados do array de inserção de dados.
     *
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
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     *
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
            'class' => 'form-control decimal'
        ));
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }


    /**
     * Gera o código para o Form do filtro em Gear\Mvc\Search\SearchForm
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\SearchFormInterface::getSearchFormElement()
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
            'class' => 'form-control decimal'
        ));
        \${$var}Pre->setLabel('$label de');
        \$this->add(\${$var}Pre);

        \${$var}Pos = new Element('{$elementName}Pos');
        \${$var}Pos->setAttributes(array(
            'name' => '{$elementName}Pos',
            'id' => '{$elementName}Pos',
            'type' => 'text',
            'class' => 'form-control decimal'
        ));
        \${$var}Pos->setLabel('até');
        \$this->add(\${$var}Pos);

EOS;
        return $element;
    }

    /**
     * Gera o código para a view do filtro em Gear\Mvc\View\ViewService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\SearchFormInterface::getSearchViewElement()
     *
     * @return string
     */
    public function getSearchViewElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
    <div class="col-lg-12">
        <div class="form-group">
             <?php echo \$this->formRow(\$form->get('{$elementName}Pre'));?>
        </div>
        <div class="form-group">
             <?php echo \$this->formRow(\$form->get('{$elementName}Pos'));?>
        </div>
    </div>

EOS;
        return $element;
    }
}
