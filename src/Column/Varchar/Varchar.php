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
     * Retorna filtro básico para as colunas em Gear\Mvc\Filter\FilterService
     *
     * @return string
     */
    public function filterElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $minLength = $this->getMinLength();
        $maxLength = $this->column->getCharacterMaximumLength();

        $element = <<<EOS
        \$messageMax = 'O valor deve ter no máximo %max% caracteres';
        \$messageMin = 'O valor deve ter no mínimo %min% caracteres';
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min' => {$minLength},
                            'max' => {$maxLength},
                            'messages' => [
                                \Zend\Validator\StringLength::TOO_SHORT => \$messageMin,
                                \Zend\Validator\StringLength::TOO_LONG => \$messageMax
                            ***REMOVED***
                        )
                    )
                )
            )
        );

EOS;

        return $element;
    }

    /**
     * Gera o valor mínimo que será utilizado nos filtros padrões.
     * Será utilizado 3 caracteres e isso é totalmente configurável na regra de negócios.
     * Após a geração do cucumberjs steps.
     * Para criar basta ter um mínimo qualquer estipulado pra garantir a formula.
     *
     * @return int
     */
    public function getMinLength()
    {
        return 3;
    }


    /**
     * Retorna filtro para colunas únicas em Gear\Mvc\Filter\FilterService
     *
     * @return string
     */
    public function filterUniqueElement()
    {

        $elementName = $this->column->getName();

        $columnName = $this->str('var', $elementName);

        $elementLabel = $this->str('label', $this->column->getName());

        $elementClass = $this->str('var-length', 'id'.$this->str('class', $this->column->getTableName()));

        $tableName  = $this->column->getTableName();
        $tableLabel = $this->str('label', $this->column->getTableName());

        $primaryKey = 'id_'.$this->str('uline', $this->column->getTableName());

        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $minLength = $this->getMinLength();
        $maxLength = $this->column->getCharacterMaximumLength();

        $element = <<<EOS
        \$messageMax = 'O valor deve ter no máximo %max% caracteres';
        \$messageMin = 'O valor deve ter no mínimo %min% caracteres';
        \$this->add(
            array(
                'name' => '$columnName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min' => {$minLength},
                            'max' => {$maxLength},
                            'messages' => [
                                \Zend\Validator\StringLength::TOO_SHORT => \$messageMin,
                                \Zend\Validator\StringLength::TOO_LONG => \$messageMax
                            ***REMOVED***
                        )
                    ),
                    \$this->getNoRecordExistValidator(
                        '$tableLabel',
                        '$elementLabel',
                        '$tableName',
                        '$elementName',
                        '$primaryKey',
                        \${$elementClass}
                    )
                )
            )
        );

EOS;
        return $element;
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
