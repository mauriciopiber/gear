<?php
namespace Gear\Column;

use Zend\Db\Metadata\Object\ColumnObject;
use Zend\Db\Metadata\Object\ConstraintObject;
use Gear\Column\UniqueInterface;
use Gear\Module\ModuleAwareTrait;
use GearBase\Util\String\StringServiceTrait;

/**
 *
 * Classe pai das colunas
 *
 * Classe que serve como base para o funcionamento das colunas
 *
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
abstract class AbstractColumn implements UniqueInterface
{
    use ModuleAwareTrait;

    use StringServiceTrait;

    protected $column;

    protected $serviceLocator;

    protected $uniqueConstraint;

    public static $tableStepFixture = '                    %s: \'%s\',';

    public static $mvcFeatureValidationTemplate = 'E eu vejo a o aviso de validação que "%s" no campo "%s"';

    public static $mvcFeatureNotNullMessage = 'O valor é obrigatório e não pode estar vazio';

    public static $mvcFeatureInvalidMessage = 'O valor é inválido';

    public static $mvcFeatureMaxMessage = 'O valor deve ter no máximo %d caracteres';

    public static $mvcFeatureUniqueMessage = 'Valor já está sendo utilizado';

    public static $mvcFeatureMinMessage = 'O valor deve ter no mínimo %d caracteres';

    public static $mvcFeatureNullTemplate = 'E eu vejo o valor "" no campo "%s"';

    public static $mvcFeatureSendKeysTemplate = 'E eu entro com o valor "%s" no campo "%s"';

    public static $mvcArrayTemplate = '\'%s\' => \'%s\',';

    public static $mvcAssertTemplate = '$this->assertEquals(\'%s\', $resultSet->get%s());';


    /**
     * Constroi o objeto Coluna.
     *
     * @param ColumnObject $column Coluna
     */
    public function __construct(ColumnObject $column)
    {
        $this->setColumn($column);
    }

    /**
     * @param \Zend\Db\Metadata\Object\ConstraintObject $uniqueConstraint Constraint Unique.
     *
     * {@inheritDoc}
     * @see \Gear\Column\UniqueInterface::setUniqueConstraint()
     *
     * @return $this
     */
    public function setUniqueConstraint(ConstraintObject $uniqueConstraint)
    {
        $this->uniqueConstraint = $uniqueConstraint;
        return $this;
    }

    /**
     * Scallfolding of fixture entity setters for Gear\Mvc\Fixture\Fixture
     */
    public function getFixtureEntitySetters()
    {
        $message = sprintf(
            '            $%s->set%s($fixture[\'%s\'***REMOVED***);',
            $this->str('var-length', $this->getColumn()->getTableName()),
            $this->str('class', $this->getColumn()->getName()),
            $this->str('var', $this->getColumn()->getName())
        );

        if (strlen($message) < 120) {
            return $message.PHP_EOL;
        }

        $template = <<<EOS
            $%s->set%s(
                \$fixture['%s'***REMOVED***
            );
EOS;

        $message = sprintf(
            $template,
            $this->str('var-length', $this->getColumn()->getTableName()),
            $this->str('class', $this->getColumn()->getName()),
            $this->str('var', $this->getColumn()->getName())
        );

        return $message.PHP_EOL;
    }


    /**
     * Gera a fixture para os testes e2e.
     *
     * @param int $iterator Número base
     *
     * @return string
     */

    public function getTableStepFixture($iterator)
    {
        $columnName = $this->str('uline', $this->column->getName());
        $columnValue = $this->getValueDatabase($iterator);

        return sprintf(static::$tableStepFixture, $columnName, $columnValue).PHP_EOL;
    }

    /**
     * Gera o teste unitário para verificar se o elemento existe no form
     */
    public function getAssertFormElement()
    {
        $template = '$this->assertInstanceOf(\'Zend\Form\Element\', $this->form->get(\'%s\'));';

        $ndnt = str_repeat(' ', 4*2);

        $name = $this->str('var', $this->column->getName());

        return $ndnt.sprintf($template, $name).PHP_EOL;
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

        return $ndnt.sprintf(self::$mvcArrayTemplate, $name, $this->getValue($iterator)).PHP_EOL;
    }

    /**
     * Gera os valores utilizados nos testes unitários, para conferir se o valor enviado foi salvo corretamente
     *
     * @param unknown $iterator
     * @return string
     */
    public function getAssertData($iterator)
    {
        $ndnt = str_repeat(' ', 4*2);

        $name = $this->str('class', $this->column->getName());

        return $ndnt.sprintf(self::$mvcAssertTemplate, $this->getValueDatabase($iterator), $name).PHP_EOL;
    }

    /**
     * Gera os valores que são usados no Filter do Constructor Db.
     *
     * @param int $iterator Número Base
     *
     * @return string
     */
    public function getFilterData($iterator = 99)
    {
        $ndnt = str_repeat(' ', 4*3);

        $name = $this->str('var', $this->column->getName());

        return $ndnt.sprintf(self::$mvcArrayTemplate, $name, $this->getValue($iterator)).PHP_EOL;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Gear\Column\UniqueInterface::getUniqueConstraint()
     *
     * @return \Zend\Db\Metadata\Object\ConstraintObject
     */
    public function getUniqueConstraint()
    {
        return $this->uniqueConstraint;
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
        return sprintf('%02d%s', $iterator, $this->str('label', $this->column->getName()));
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
        return sprintf('%02d%s', $iterator, $this->str('label', $this->column->getName()));
    }

    /**
     * Formata o código para a indentação e para ir para próxima linha.
     *
     * @param int $indent Indentação do código gerado.
     * @param unknown $sprintf Texto a ser formatado.
     *
     * @return string
     */
    public function format($indent, $sprintf)
    {
        return $indent.$sprintf.PHP_EOL;
    }

    /**
     * Cria código para as validações de Forms para campos "nullable" e "not nullable"
     *
     * @param number $indent Indentação do Código.
     *
     * @return string
     */
    public function getIntegrationActionIsNullable($indent = 6)
    {
        $ndnt = str_repeat(' ', $indent);

        $columnLabel = $this->str('label', $this->column->getName());

        if ($this->column->isNullable() === true) {
            //retorna o template para input vazio.
            return $this->format($ndnt, sprintf(static::$mvcFeatureNullTemplate, $columnLabel));
        }

        //retorna o template com a mensagem de validação
        $text = sprintf(static::$mvcFeatureValidationTemplate, static::$mvcFeatureNotNullMessage, $columnLabel);

        return $this->format($ndnt, $text);
    }

    public function getEntityAssertNull()
    {
        $column = $this->getColumn();
        $method = sprintf('get%s', $this->str('class', $column->getName()));
        return sprintf('$this->assertNull($this->entity->%s());', $method);
    }

    public function getEntityParam()
    {
        return sprintf('        $%s', $this->str('var', $this->getColumn()->getName()));
    }

    public function getEntitySetter()
    {
        $column = $this->getColumn();

        $template = <<<EOS
        \$this->entity->set%s($%s);
        \$this->assertEquals($%s, \$this->entity->get%s());

EOS;

        $setter = sprintf(
            $template,
            $this->str('class', $column->getName()),
            $this->str('var', $column->getName()),
            $this->str('var', $column->getName()),
            $this->str('class', $column->getName())
        );
        return $setter;
    }

    public function getEntityDataProvider()
    {
        return '                \''.$this->str('label', $this->getColumn()->getName()).'\'';
    }

    /**
     * indenta N espaços.
     *
     * @param int $indent Quantidade de espaços
     */
    public function indent($indent)
    {
        return str_repeat(' ', $indent);
    }

    /**
     * Cria código para as validações de Forms para formatos dos campos, quando há mascaras.
     *
     * @param number $indent
     * @return string
     */
    public function getIntegrationActionIsInvalid($indent = 6)
    {
        $columnLabel = $this->str('label', $this->column->getName());

        $text = sprintf(static::$mvcFeatureValidationTemplate, static::$mvcFeatureInvalidMessage, $columnLabel);

        return $this->format($this->indent($indent), $text);
    }

    public function getTextMaxLength($maxLength)
    {
        $text  = 'abcdefghijklmnopqrstujxywz';

        $clock = 0;

        $sendKeys = '';

        for ($i = 0; $i < $maxLength; $i++) {
            if (!isset($text[$clock***REMOVED***)) {
                $clock = 0;
            }

            $sendKeys .= $text[$clock***REMOVED***;

            $clock += 1;
        }

        return $sendKeys;
    }

    /**
     * Cria código para verificação do tamanho máximo da entrada, sendkeys
     */
    public function getIntegrationSendKeysValidateMax()
    {
        $attribute = $this->str('label', $this->column->getName());

        $maxLength = $this->column->getCharacterMaximumLength();

        $sendkeys = $this->getTextMaxLength($maxLength+1);

        $view = sprintf(static::$mvcFeatureSendKeysTemplate, $sendkeys, $attribute);

        return $this->format($this->indent(6), $view);
    }

    /**
     * Cria código para verificação do tamanho minimo da entrada, sendkeys
     */
    public function getIntegrationSendKeysValidateMin()
    {
        $attribute = $this->str('label', $this->column->getName());

        $text  = 'ab';

        $view = sprintf(static::$mvcFeatureSendKeysTemplate, $text, $attribute);

        return $this->format($this->indent(6), $view);
    }

    /**
     * Cria código para verificação do tamanho máximo da entrada, expect
     */
    public function getIntegrationExpectValidateUnique($indent = 6)
    {
        $columnLabel = $this->str('label', $this->column->getName());

        $text = sprintf(static::$mvcFeatureValidationTemplate, static::$mvcFeatureUniqueMessage, $columnLabel);

        return $this->format($this->indent($indent), $text);
    }

    /**
     * Cria código para verificação do tamanho máximo da entrada, expect
     */
    public function getIntegrationExpectValidateMax($indent = 6)
    {
        $columnLabel = $this->str('label', $this->column->getName());

        $value = $this->column->getCharacterMaximumLength();

        $featureMessage = sprintf(static::$mvcFeatureMaxMessage, $value);

        $text = sprintf(static::$mvcFeatureValidationTemplate, $featureMessage, $columnLabel);

        return $this->format($this->indent($indent), $text);
    }

    /**
     * Cria código para verificação do tamanho minimo da entrada, expect
     */
    public function getIntegrationExpectValidateMin($indent = 6)
    {
        $columnLabel = $this->str('label', $this->column->getName());

        $text = sprintf(static::$mvcFeatureValidationTemplate, sprintf(static::$mvcFeatureMinMessage, 3), $columnLabel);

        return $this->format($this->indent($indent), $text);
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número
     * @param int $line    Linha
     *
     * @return string
     */
    public function getIntegrationActionSendKeys($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = sprintf(static::$mvcFeatureSendKeysTemplate, $value, $attribute);

        return $this->format($this->indent(6), $view);
    }

    /**
     * Cria código para verificação dos campos inválidos das coluna em spec feature.
     *
     * @param int $default Número
     * @param int $line    Linha
     *
     * @return string
     */
    public function getIntegrationActionSendKeysInvalid($default = 30, $line = 1)
    {
        $attribute = $this->str('label', $this->column->getName());

        $view = sprintf(static::$mvcFeatureSendKeysTemplate, 'ABCDEF', $attribute);

        return $this->format($this->indent(6), $view);
    }


    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número
     * @param int $line    Número de linhas
     *
     * @return string
     */
    public function getIntegrationActionExpectValue($data)
    {
        $default = isset($data['default'***REMOVED***) ? $data['default'***REMOVED*** : 30;
        $line = isset($data['line'***REMOVED***) ? $data['line'***REMOVED*** : 1;

        $value = sprintf($this->getValue($default), $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu vejo o valor "{$value}" no campo "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número
     * @param int $line    Número de linhas
     *
     * @return string
     */
    public function getIntegrationActionList($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
    E eu vejo o campo "{$attribute}" com o valor "{$value}" na linha "{$line}"

EOS;
        return $view;
    }


    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número
     *
     * @return string
     */
    public function getIntegrationActionView($default = 30)
    {
        $value = sprintf($this->getValue($default), $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu vejo o atributo "{$attribute}" com o valor "{$value}"

EOS;
        return $view;
    }

    /**
     * Recebe uma coluna e devolve a variável válida
     *
     * @param ColumnObject $column Coluna a ter o var extraído
     *
     * @return string
     */
    public function getColumnVar($column)
    {
        if (strlen($column->getName()) > 18) {
            $var = $this->str('var', substr($column->getName(), 0, 15));
        } else {
            $var = $this->str('var', $column->getName());
        }
        return $var;
    }

    /**
     * Retorna a coluna que está interpretando as regras.
     *
     * @return \Zend\Db\Metadata\Object\ColumnObject
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Informa qual coluna deverá interpretar as regras.
     *
     * @param ColumnObject $column Coluna Utilizada.
     *
     * @return \Gear\Column\AbstractColumn
     */
    public function setColumn(ColumnObject $column)
    {
        $this->column = $column;
        return $this;
    }

    /**
     * Função principal usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     *
     * @param string $label Label que será utilizado.
     * @param string $value Valor que será utilizado.
     *
     * @return string
     */
    public function getViewColumnLayout($label, $value)
    {
        $value = <<<EOS
                        <tr>
                            <td>
                                <?php echo \$this->translate('{$label}');?>
                            </td>
                            <td>
                                <?php echo \$this->escapeHtml({$value});?>
                            </td>
                        </tr>

EOS;

        return $value;
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
            sprintf('$this->%s', $this->str('var', $this->column->getName()))
        );
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     * Função default que será chamada caso não esteja declarada nenhuma função de fixture nas classes filhas.
     *
     * @param int $iterator Número da fixture
     *
     * @return string
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \''.$this->getValue($iterator).'\',',
            $this->str('var', $this->column->getName()),
            $iterator,
            $this->str('label', $this->column->getName())
        ).PHP_EOL;
    }

    /**
     * Utilizado em testes e2e
     *
     * @param int $number Número específico do teste.
     *
     * @return string
     */
    public function getFixtureDefault($number)
    {
        return sprintf(
            '%s',
            sprintf('%s%02d', $this->str('var', $this->column->getName()), $number)
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
        \${$var} = new Element('{$elementName}');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'text',
            'class' => 'form-control'
        ));
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    /**
     * Retorna html utilizado nos Forms em Gear\Mvc\View\ViewService
     *
     * @return string
     */
    public function getViewFormElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
                        <div class="form-group">
                            <?php echo \$this->formRow(\$form->get('$elementName'));?>
                        </div>

EOS;
        return $element;
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

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$columnName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
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
     * Retorna filtro básico para as colunas em Gear\Mvc\Filter\FilterService
     *
     * @return string
     */
    public function filterElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
            )
        );

EOS;

        return $element;
    }

    /**
     * Formata o elemento utilizado para coluna em Gear\Mvc\Filter\FilterService
     *
     * @return string
     */
    public function getFilterFormElement()
    {
        if ($this->getUniqueConstraint() instanceof ConstraintObject) {
            ///var_dump($this->getUniqueConstraint());die();
            return $this->filterUniqueElement();
        }
        return $this->filterElement();
    }

    /**
     * Formata o elemento utilizado para coluna em Gear\Mvc\View\ViewService
     *
     * @return string
     */
    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $element = <<<EOS
                        <td>
                            <span ng-bind="{$tableVar}.{$elementName}"></span>
                        </td>

EOS;
        return $element;
    }
}
