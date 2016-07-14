<?php
namespace Gear\Column\Time;

use Gear\Column\Datetime\AbstractDateTime;

/**
 *
 * Classe que cria colunas Time
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
class Time extends AbstractDateTime
{
    /**
     * @param ColumnObject $column Coluna
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     */
    public function __construct($column)
    {
        if ($column->getDataType() !== 'time') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /*
    public function getFixtureDefault($number = null)
    {
        unset($number);

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 01:01:01');
        return $date->format('H:i:s');
    }

    public function getFixtureDefaultDb()
    {
        return date('H:i:s');
    }
    */


    /**
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string Formato utilizado para Form/View
     */
    public function getValueDatabase($iterator)
    {
        return $this->getValue($iterator);
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
        $minuto = 0;

        $hora = $this->getValidHour($iterator);

        $text = sprintf('%02d:%02d:%02d', $hora, $minuto, 02);

        return $text;
        //return $text.':%02d';
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     *
     * @param int $iterator Número base
     *
     * @return string
     */
    public function getFixtureData($iterator)
    {
        $minuto = 0;

        $hora = ($iterator > 23) ? ($iterator%24) : $iterator;

        $time = sprintf('%02d:%02d:%02d', $hora, $minuto, 02);

        return sprintf(
            '                \'%s\' => \DateTime::createFromFormat(\'H:i:s\', \'%s\'),',
            $this->str('var', $this->column->getName()),
            $time
        ).PHP_EOL;
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
            sprintf('$this->%s->format(\'H:i:s\')', $this->str('var', $this->column->getName()))
        );
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     * Controller para array de inserção de dados.
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
            $date->format('H:i:s')
        ).PHP_EOL;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     * Controller para array de inserção de dados.
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
            $date->format('H:i:s')
        ).PHP_EOL;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     * Controller para assert com os dados do array de inserção de dados.
    *
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn()
    {
        $date = \DateTime::createFromFormat(
            $this->getDateTimeGlobalFormat(),
            $this->getInsertTime()->format($this->getDateTimeGlobalFormat())
        );

        $insertAssert = '        ';
        $insertAssert .= sprintf(
            '$this->assertEquals(\'%s\', $resultSet->get%s()->format(\'%s\'));',
            $date->format($this->getTimeGlobalFormat()),
            $this->str('class', $this->column->getName()),
            $this->getTimeGlobalFormat()
        ).PHP_EOL;

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
        \${$var} = new Element\Time('$elementName');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'step' => 'any',
            'type' => 'text',
            'class' => 'form-control time'
        ));
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    /**
     * Função usada na listagem da tabela em Gear\Mvc\View\ViewService
     *
     * @return string
     */
    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());



        $element = <<<EOS
                         <td>
                             <span ng-bind="{$tableVar}.{$elementName}.date | Time"></span>
                         </td>

EOS;
        return $element;
    }
}
