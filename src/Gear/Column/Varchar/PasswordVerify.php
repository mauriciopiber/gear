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
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número base.
     * @param int $line    Line.
     *
     * @return string
     */
    public function getIntegrationActionSendKeys($default = 30, $line = 1)
    {
        $value = substr(sprintf($this->getValue($default), $default, $this->str('class', $this->column->getName())), 0, 20);
        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu entro com o valor "{$value}" no campo "{$attribute}"
      E eu entro com o valor "{$value}" no campo "{$attribute} Verify"

EOS;
        return $view;
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

    public function getControllerUse()
    {
        return <<<EOS
use GearBase\Controller\PasswordVerifyTrait;

EOS;
    }

    public function getControllerAttribute()
    {
        return <<<EOS
    use PasswordVerifyTrait;

EOS;
    }

    public function getServiceUse()
    {
        return <<<EOS
use GearBase\Service\PasswordVerifyTrait;

EOS;
    }

    public function getServiceAttribute()
    {
        return <<<EOS
    use PasswordVerifyTrait;

EOS;
    }

    public function getServiceDeleteBody()
    {
        return '';
    }



    public function getVerifyUpdateColumn()
    {

        return <<<EOS
            '{$this->str('var', $this->column->getName())}' => '{$this->getBaseMessage('update', $this->column)}',

EOS;

    }

    public function getVerifyVerifyUpdateColumn()
    {

        return <<<EOS
            '{$this->str('var', $this->column->getName())}Verify' => '{$this->getBaseMessage('update', $this->column)}',

EOS;

    }


    public function getInsertArrayByColumn()
    {
        return <<<EOS
            '{$this->str('var', $this->column->getName())}' => '{$this->getBaseMessage('insert', $this->column)}',
            '{$this->str('var', $this->column->getName())}Verify' => '{$this->getBaseMessage('insert', $this->column)}',

EOS;

    }


    public function getVerifyInsertColumn()
    {
        return <<<EOS
            '{$this->str('var', $this->column->getName())}' => '{$this->getBaseMessage('insert', $this->column)}',

EOS;

    }

    public function getVerifyVerifyInsertColumn()
    {
        return <<<EOS
            '{$this->str('var', $this->column->getName())}Verify' => '{$this->getBaseMessage('insert', $this->column)}',

EOS;

    }


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

    public function getControllerPreShow()
    {
        $elementName = $this->str('class', $this->column->getName());
        $element = <<<EOS
        \$this->data->set$elementName('');

EOS;
        return $element;

    }

    public function getServiceInsertBody()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        \$this->createPassword('$elementName');

EOS;

        return $element;
    }

    public function getServiceUpdateBody()
    {
        return $this->getServiceInsertBody();
    }

    public function getServiceInsertSuccess()
    {
        return '';
    }

    public function getServiceUpdateSuccess()
    {
        return '';
    }

    public function serviceInsert()
    {

    }

    public function serviceUpdate()
    {
        return $this->serviceInsert();
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
        \$this->add(array(
            'name'       => '$elementName',
            'required'   => true,
            'filters'    => array(array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'min' => 6,
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
                    ),
                ),
                array(
                    'name'    => 'Identical',
                    'options' => array(
                        'token' => '$elementName',
                    ),
                ),
            ),
        ));

EOS;

        return $element;
    }
}
