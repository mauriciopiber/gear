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
    private static $view = '%02d:%02d:%02d';

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

    /**
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     * No caso de Time, utiliza a mesma forma da View.
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string Formato utilizado para Database
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

        $second = $this->getValidSecond($iterator);

        $text = sprintf(static::$view, $hora, $minuto, $second);

        return $text;
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

        $second = $this->getValidSecond($iterator);

        $time = sprintf('%02d:%02d:%02d', $hora, $minuto, $second);

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
