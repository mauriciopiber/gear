<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;
use Gear\Column\Mvc\ControllerInterface;
use Gear\Column\Mvc\ServiceAwareInterface;

/**
 *
 * Classe que cria à coluna de senha
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
class PasswordVerify extends Varchar implements ServiceAwareInterface, ControllerInterface
{
    const PASSWORD = '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG';

    /**
     * Gera os valores que são usados no Filter do Constructor Db.
     *
     * @param int $iterator Número Base
     *
     * @return string
     */
    public function getFilterData($iterator)
    {
        $ndnt = str_repeat(' ', 4*5);
        $name = $this->str('var', $this->column->getName());
        $filter = $ndnt.sprintf('\'%s\' => \'%s\',', $name, $this->getValue($iterator)).PHP_EOL;
        $filter .= $ndnt.sprintf('\'%s\' => \'%s\',', $name.'Verify', $this->getValue($iterator)).PHP_EOL;
        return $filter;
    }


    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número base.
     * @param int $line    Line.
     *
     * @return string
     */
    public function getIntegrationActionSendKeys($default = 30, $line = 1)
    {
        $value = $this->getValue($default);
        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu entro com o valor "{$value}" no campo "{$attribute}"
      E eu entro com o valor "{$value}" no campo "{$attribute} Verify"

EOS;
        return $view;
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

        $data = $ndnt.sprintf(self::$mvcArrayTemplate, $name, $this->getValue($iterator)).PHP_EOL;
        $data .= $ndnt.sprintf(self::$mvcArrayTemplate, $name.'Verify', $this->getValue($iterator)).PHP_EOL;

        return $data;
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
        return substr(sprintf('%02d%s', $iterator, $this->str('class', $this->column->getName())), 0, 20);
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
        return substr(sprintf('%02d%s', $iterator, $this->str('class', $this->column->getName())), 0, 20);
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
            $text = $this->format($ndnt, sprintf(static::$mvcFeatureNullTemplate, $columnLabel));
            $text .= $this->format($ndnt, sprintf(static::$mvcFeatureNullTemplate, $columnLabel.' Verify'));
            return $text;
       }

       $verify = $columnLabel.' Verify';

        //retorna o template com a mensagem de validação
        $column = sprintf(static::$mvcFeatureValidationTemplate, static::$mvcFeatureNotNullMessage, $columnLabel);
        $text = $this->format($ndnt, $column);

        $verifyColumn = sprintf(static::$mvcFeatureValidationTemplate, static::$mvcFeatureNotNullMessage, $verify);
        $text .= $this->format($ndnt, $verifyColumn);

        return $text;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número base.
     * @param int $line    Line.
     *
     * @return string
     */
    public function getIntegrationActionExpectValue($default = 30, $line = 1)
    {
        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu vejo o valor "" no campo "{$attribute}"
      E eu vejo o valor "" no campo "{$attribute} Verify"

EOS;
        return $view;
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
        return sprintf(
            '                \'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            self::PASSWORD
        ).PHP_EOL;
    }

    /**
     * Retorna as classes que serão usadas para criar o controller em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerUse()
    {
        return <<<EOS
use GearBase\Controller\PasswordVerifyTrait;

EOS;
    }

    /**
     * Retorna os atributos de instancia das dependências do controller em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerAttribute()
    {
        return <<<EOS
    use PasswordVerifyTrait;

EOS;
    }

    /**
     * Retorna as classes de instancia das dependências do service em Gear\Mvc\Service\ServiceService
     *
     * @return string
     */
    public function getServiceUse()
    {
        return <<<EOS
use GearBase\Service\PasswordVerifyTrait;

EOS;
    }

    /**
     * Retorna os atributos de instancia das dependências do service em Gear\Mvc\Service\ServiceService
     *
     * @return string
     */
    public function getServiceAttribute()
    {
        return <<<EOS
    use PasswordVerifyTrait;

EOS;
    }

    /**
     * Código para ser utilizado após deletar ítem em Service
     *
     * @return string
     */
    public function getServiceDeleteBody()
    {
        return '';
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
     *
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $value = $this->getValue($this->reference);

        return <<<EOS
            '{$this->str('var', $this->column->getName())}' => '{$value}',
            '{$this->str('var', $this->column->getName())}Verify' => '{$value}',

EOS;
    }

    /**
     * Código que é executado antes da validação do Controller
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ControllerInterface::getControllerPreValidate()
     *
     * @return string
     */
    public function getControllerPreValidate()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        \$this->getRequestPlugin()->addFilter(
            '$elementName',
            \$this->getPasswordVerifyFilter()
        );

EOS;
        return $element;
    }

    /**
     * Código que é utilizado antes de exibir o form no Controller
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ControllerInterface::getControllerPreShow()
     *
     * @return string
     */
    public function getControllerPreShow()
    {
        $elementName = $this->str('class', $this->column->getName());
        $element = <<<EOS
        \$this->data->set$elementName('');

EOS;
        return $element;
    }

    /**
     * Código que é executado antes do service enviar o pedido de criar para o repository
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceUpdateBody()
     *
     * @return string
     */
    public function getServiceInsertBody()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        \$this->createPassword('$elementName');

EOS;

        return $element;
    }

    /**
     * Código que é executado antes do service enviar o pedido de atualizar para o repository
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceUpdateBody()
     *
     * @return string
     */
    public function getServiceUpdateBody()
    {
        return $this->getServiceInsertBody();
    }

    /**
     * Código que é executado quanto a entidade é criada
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceInsertSuccess()
     *
     * @return string
     */
    public function getServiceInsertSuccess()
    {
        return '';
    }

    /**
     * Código que é executado quando a entidade é atualizada com sucesso
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceUpdateSuccess()
     *
     * @return string
     */
    public function getServiceUpdateSuccess()
    {
        return '';
    }


    /**
     * Cria código para verificação do tamanho máximo da entrada, sendkeys
     */
    public function getIntegrationSendKeysValidateMax()
    {
        $attribute = $this->str('label', $this->column->getName());

        $sendkeys = $this->getTextMaxLength(21);

        $view = sprintf(static::$mvcFeatureSendKeysTemplate, $sendkeys, $attribute);

        $output = $this->format($this->indent(6), $view);

        $view = sprintf(static::$mvcFeatureSendKeysTemplate, $sendkeys, $attribute.' Verify');

        $output .= $this->format($this->indent(6), $view);

        return $output;
    }

    /**
     * Cria código para verificação do tamanho minimo da entrada, sendkeys
     */
    public function getIntegrationSendKeysValidateMin()
    {
        $attribute = $this->str('label', $this->column->getName());

        $text  = 'ab';

        $view = sprintf(static::$mvcFeatureSendKeysTemplate, $text, $attribute);

        $output = $this->format($this->indent(6), $view);

        $view = sprintf(static::$mvcFeatureSendKeysTemplate, $text, $attribute.' Verify');

        $output .= $this->format($this->indent(6), $view);

        return $output;
    }


    /**
     * Cria código para verificação do tamanho máximo da entrada, expect
     */
    public function getIntegrationExpectValidateMax($indent = 6)
    {
        $columnLabel = $this->str('label', $this->column->getName());

        $value = 20;

        $featureMessage = sprintf(static::$mvcFeatureMaxMessage, $value);

        $text = sprintf(static::$mvcFeatureValidationTemplate, $featureMessage, $columnLabel);

        $output = $this->format($this->indent($indent), $text);

        $text = sprintf(static::$mvcFeatureValidationTemplate, $featureMessage, $columnLabel.' Verify');

        $output .= $this->format($this->indent($indent), $text);

        return $output;
    }

    /**
     * Cria código para verificação do tamanho minimo da entrada, expect
     */
    public function getIntegrationExpectValidateMin($indent = 6)
    {
        $columnLabel = $this->str('label', $this->column->getName());

        $text = sprintf(static::$mvcFeatureValidationTemplate, sprintf(static::$mvcFeatureMinMessage, 6), $columnLabel);

        $output = $this->format($this->indent($indent), $text);

        $text = sprintf(static::$mvcFeatureValidationTemplate, sprintf(static::$mvcFeatureMinMessage, 6), $columnLabel.' Verify');

        $output .= $this->format($this->indent($indent), $text);

        return $output;
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
            'type' => 'password',
            'class' => 'form-control'
        ));
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

        \${$var}Verify = new Element('{$elementName}Verify');
        \${$var}Verify->setAttributes(array(
            'name' => '{$elementName}Verify',
            'id' => '{$elementName}Verify',
            'type' => 'password',
            'class' => 'form-control'
        ));
        \${$var}Verify->setLabel('$label Verify');
        \$this->add(\${$var}Verify);
EOS;
        return $element.PHP_EOL;
    }

    /**
     * Retorna a exibição do form nos viewhelpers utilizado em Gear\Mvc\View\ViewService
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getViewFormElement()
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
        <div class="form-group">
            <?php echo \$this->formRow(\$form->get('{$elementName}Verify'));?>
        </div>

EOS;
        return $element;
    }

    /**
     * Retorna o filtro do form para Gear\Mvc\Filter\FilterService
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getFilterFormElement()
     *
     * @return string
     */
    public function getFilterFormElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        //$required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$messageMax = 'O valor deve ter no máximo %max% caracteres';
        \$messageMin = 'O valor deve ter no mínimo %min% caracteres';
        \$this->add(array(
            'name'       => '$elementName',
            'required'   => true,
            'filters'    => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'min' => 6,
                        'max' => 20,
                        'messages' => [
                            \Zend\Validator\StringLength::TOO_SHORT => \$messageMin,
                            \Zend\Validator\StringLength::TOO_LONG => \$messageMax
                        ***REMOVED***
                    ),
                ),
            ),
        ));

        \$this->add(array(
            'name'       => '{$elementName}Verify',
            'required'   => true,
            'filters'    => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'min' => 6,
                        'max' => 20,
                        'messages' => [
                            \Zend\Validator\StringLength::TOO_SHORT => \$messageMin,
                            \Zend\Validator\StringLength::TOO_LONG => \$messageMax
                        ***REMOVED***
                    ),
                    'break_chain_on_failure' => true
                ),
                array(
                    'name'    => 'Identical',
                    'options' => array(
                        'token' => '$elementName',
                        'messages' => [
                            \Zend\Validator\Identical::NOT_SAME => 'Os dois valores digitados não combinam.'
                        ***REMOVED***
                    ),
                ),
            ),
        ));

EOS;

        return $element;
    }
}
