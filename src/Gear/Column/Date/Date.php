<?php
namespace Gear\Column\Date;

use Gear\Column\Datetime\AbstractDateTime;

/**
 *
 * Classe que cria colunas Date
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
class Date extends AbstractDateTime
{
    /**
     * @param ColumnObject $column Coluna
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     */
    public function __construct($column)
    {
        if ($column->getDataType() !== 'date') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /**
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string Formato utilizado para Database
     */
    public function getValueDatabase($iterator)
    {
        $dia = $this->getValidDay($iterator);
        $mes = $this->getValidMonth($iterator);
        $ano = $this->getValidYear($iterator);

        $value = sprintf('%04d-%02d-%02d', $ano, $mes, $dia);

        return $value;
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
        $dia = $this->getValidDay($iterator);
        $mes = $this->getValidMonth($iterator);
        $ano = $this->getValidYear($iterator);

        $value = sprintf('%04d-%02d-%02d', $ano, $mes, $dia);

        return $value;
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
        $dia = $this->getValidDay($iterator);
        $mes = $this->getValidMonth($iterator);
        $ano = $this->getValidYear($iterator);

        $time = sprintf('%04d-%02d-%02d', $ano, $mes, $dia);

        $template = '                \'%s\' => \DateTime::createFromFormat(\'Y-m-d\', \'%s\'),'.PHP_EOL;

        return sprintf(
            $template,
            $this->str('var', $this->column->getName()),
            $time
        );
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
            sprintf(
                '($this->%s !== null) ? $this->%s->format(\'Y-m-d\') : \'\'',
                $this->str('var', $this->column->getName()),
                $this->str('var', $this->column->getName())
            )
        );
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
        \${$var} = new Element\Date('{$elementName}');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'text',
            'class' => 'form-control date'
        ));
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    /**
     * Função usada em Gear\Mvc\Search\SearchService
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
        \${$var} = new Element\Date('{$elementName}Pre');
        \${$var}->setAttributes(array(
            'name' => '{$elementName}Pre',
            'id' => '{$elementName}Pre',
            'type' => 'date',
            'step' => 'any',
            'class' => 'form-control date'
        ));
        \${$var}->setLabel('$label de');
        \$this->add(\${$var});

        \${$var} = new Element\Date('{$elementName}Pos');
        \${$var}->setAttributes(array(
            'name' => '{$elementName}Pos',
            'id' => '{$elementName}Pos',
            'type' => 'date',
            'step' => 'any',
            'class' => 'form-control date'
        ));
        \${$var}->setLabel('até');
        \$this->add(\${$var});

EOS;
        return $element;
    }

    /**
     * Função usada em Gear\Mvc\View\ViewService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\SearchFormInterface::getSearchFormElement()
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
                             <span ng-bind="{$tableVar}.{$elementName}.date | DateEnUs"></span>
                         </td>

EOS;

        return $element;
    }
}
