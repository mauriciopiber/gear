<?php
namespace Gear\Column\Datetime;

use Gear\Column\Datetime\AbstractDateTime;

/**
 *
 * Classe que cria colunas Datetime
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
class Datetime extends AbstractDateTime
{
    /**
     * @param ColumnObject $column Coluna
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     */
    public function __construct($column)
    {
        if ($column->getDataType() !== 'datetime') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }


    /*
    public function getFixtureDefault($number = null)
    {
        unset($number);
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 01:01:01');
        return $date->format('Y-m-d H:i:s');
    }

    public function getFixtureDefaultDb()
    {
        return date('Y-m-d H:i:s');
    }
    */

    /**
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string Formato utilizado para Form/View
     */
    public function getValue($iterator)
    {
        $hora = ($iterator > 23) ? ($iterator%24) : $iterator;

        $dia = ($iterator > 30) ? ($iterator%30) : $iterator;

        $date = sprintf('%04d-%02d-%02d %02d:%02d:%02d', $this->ano, $this->mes, $dia, $hora, $this->minuto, $this->segundo);

        return $date;

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
        $hora = ($iterator > 23) ? ($iterator%24) : $iterator;

        $dia = ($iterator > 30) ? ($iterator%30) : $iterator;


        $time = sprintf('%04d-%02d-%02d %02d:%02d:%02d', $this->ano, $this->mes, $dia, $hora, $this->minuto, $this->segundo);

        return sprintf(
            '                \'%s\' => \DateTime::createFromFormat(\'Y-m-d H:i:s\', \'%s\'),',
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
            sprintf('$this->%s->format(\'Y-m-d H:i:s\')', $this->str('var', $this->column->getName()))
        );
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
    *
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $date = \DateTime::createFromFormat(
            $this->getDateTimeGlobalFormat(),
            $this->getInsertTime()->format($this->getDateTimeGlobalFormat())
        );

        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $date->format($this->getDateTimeGlobalFormat())
        ).PHP_EOL;

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
        $date = \DateTime::createFromFormat(
            $this->getDateTimeGlobalFormat(),
            $this->getInsertTime()->format($this->getDateTimeGlobalFormat())
        );

        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => new \DateTime(\'%s\'),',
            $this->str('var', $this->column->getName()),
            $date->format($this->getDateTimeGlobalFormat())
        ).PHP_EOL;

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
        $date = \DateTime::createFromFormat(
            $this->getDateTimeGlobalFormat(),
            $this->getInsertTime()->format($this->getDateTimeGlobalFormat())
        );


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
        \${$var} = new Element\DateTime('{$elementName}');
        \${$var}->setAttributes(array(
            'name' => '{$elementName}',
            'id' => '{$elementName}',
            'type' => 'text',
            'step' => 'any',
            'class' => 'form-control datetime'
        ));
        \${$var}->setFormat('Y-m-d H:i:s');
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    /**
     * Gera o código para a listagem em Gear\Mvc\View\ViewService
     *
     * @return string
     */
    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $element = <<<EOS

                         <td>
                             <span ng-bind="{$tableVar}.{$elementName}.date | DatetimeEnUs"></span>
                         </td>

EOS;

        return $element;
    }

    /**
     * Gera o código para o form em Gear\Mvc\Search\SearchService
     *
     * @return string
     */
    public function getSearchFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \${$var}Pre = new Element\Date('{$elementName}Pre');
        \${$var}Pre->setAttributes(array(
            'name' => '{$elementName}Pre',
            'id' => '{$elementName}Pre',
            'type' => 'date',
            'step' => 'any',
            'class' => 'form-control datetime'
        ));
        \${$var}Pre->setLabel('$label de');
        \$this->add(\${$var}Pre);

        \${$var}Pos = new Element\Date('{$elementName}Pos');
        \${$var}Pos->setAttributes(array(
            'name' => '{$elementName}Pos',
            'id' => '{$elementName}Pos',
            'type' => 'date',
            'step' => 'any',
            'class' => 'form-control datetime'
        ));
        \${$var}Pos->setLabel('até');
        \$this->add(\${$var}Pos);

EOS;
        return $element;
    }

    /**
     * Gera o código da view filtro em Gear\Mvc\View\ViewService
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
