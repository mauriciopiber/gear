<?php
namespace Gear\Column\Integer;

use Gear\Column\Integer\AbstractInt;

/**
 *
 * Classe que cria as regras de Checkbox
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
class AbstractCheckbox extends AbstractInt
{
    public static $mvcFeatureNullTemplate = 'E eu vejo desmarcada a caixa de escolha "%s"';

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Numero base
     * @param int $line    Linha
     *
     * @return boolean
     */
    public function getIntegrationActionSendKeys($default = 30, $line = 1)
    {
        $attribute = $this->str('label', $this->getColumn()->getName());

        $value = $this->getValueSendKeys($default);

        $view = <<<EOS
      E eu {$value} a caixa de escolha "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Numero base
     * @param int $line    Linha
     *
     * @return boolean
     */
    public function getIntegrationActionExpectValue($data)
    {
        $default = isset($data['default'***REMOVED***) ? $data['default'***REMOVED*** : 30;
        $line = isset($data['line'***REMOVED***) ? $data['line'***REMOVED*** : 1;

        $attribute = $this->str('label', $this->column->getName());

        $value = $this->getValueExpectValue($default);

        $view = <<<EOS
      E eu vejo {$value} a caixa de escolha "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Gera o código para ser utilizado em Gear\Mvc\View\ViewService
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getViewListRowElement()
     *
     * @return string
     */
    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $element = <<<EOS
                        <td>
                            <span ng-bind="{$tableVar}.{$elementName} | YesNo"></span>
                        </td>

EOS;
        return $element;
    }

    /**
     * Retorna o valor a ser usado nos testes unitários sem view helper
     *
     * @return int
     */
    public function getMatchReference()
    {
        return ($this->getReference()%2==0) ? 1 : 0;
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
        return ($iterator%2==0) ? 0 : 1;
    }

    /**
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string Formato utilizado para Form, por se tratar de um botão checkbox.
     */
    public function getValueSendKeys($iterator)
    {
        return ($iterator%2==0) ? 'desmarco' : 'marco';
    }

    /**
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string Formato utilizado para Form, por se tratar de um botão checkbox.
     */
    public function getValueExpectValue($iterator)
    {
        return ($iterator%2==0) ? 'desmarcada' : 'marcada';
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
        return ($iterator%2==0) ? 'Não' : 'Sim';
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     *
     * @param int $iterator Número utilizado para referência.
     * @return string
     */
    public function getFixtureData($iterator)
    {
        $int = ($iterator%2==0) ? 0 : 1;

        $columnName = $this->str('var', $this->column->getName());
        $template = '                \'%s\' => \'%d\',';

        return sprintf($template, $columnName, $int).PHP_EOL;
    }

    /**
     * Função default que será chamado em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     * caso não esteja declarada a função nas classes filhas.
     *
     * @return string
     */
    public function getViewData()
    {

        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->yesOrNot($this->%s)', $this->str('var', $this->column->getName()))
        );
    }

    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     *
     * @return string
     */
    public function getFormElement()
    {
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \$this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => '$elementName',
            'options' => array(
                'label' => '$label',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'default_value' => '0'
            ),
            'attributes' => array(
                 'value' => '0',
                 'id' => '$elementName'
            )
        ));
EOS;
        return $element.PHP_EOL;
    }

    /**
     * Gera os valores utilizados nos testes unitários, para enviar requisições.
     *
     * @param unknown $iterator
     * @return string
     */
    public function getInputData($iterator)
    {
        $ndnt = str_repeat(' ', 4*3);

        $name = $this->str('var', $this->column->getName());

        return $ndnt.sprintf(self::$mvcArrayTemplate, $name, $this->getValueDatabase($iterator)).PHP_EOL;
    }
}
