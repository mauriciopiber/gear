<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;
use Gear\Service\Column\ServiceInterface;
use Gear\Service\Column\ControllerInterface;
use Gear\Service\Column\ServiceAwareInterface;

class PasswordVerify extends Varchar implements ServiceAwareInterface, ControllerInterface
{
    const PASSWORD = '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG';

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


    public function getAcceptanceTestFillField($numberReference)
    {
        $module = $this->getModule()->getModuleName();
        $class = $this->str('class', $this->column->getTableName());
        $column = $this->str('var', $this->column->getName());
        $value = $this->getFixtureDefault($numberReference);


        return <<<EOS
        \$I->fillField(
            {$class}EditPage::\${$column},
            '$value'
        );
        \$I->fillField(
            {$class}EditPage::\${$column}Verify,
            '$value'
        );

EOS;

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
            \$this->checkPasswordVerify('$elementName');

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

    public function getFilterFormElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $name = '';
        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(array(
            'name'       => '$elementName',
            'required'   => 'true',
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
            'required'   => 'true',
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