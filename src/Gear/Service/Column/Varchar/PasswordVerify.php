<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;
use Gear\Service\Column\ServiceInterface;
use Gear\Service\Column\ControllerInterface;

class PasswordVerify extends Varchar implements ServiceInterface, ControllerInterface
{
    public function getFixtureData($iterator)
    {
        $basePass = '123456'."".$iterator;


        $bcrypt = new \Zend\Crypt\Password\Bcrypt();
        $bcrypt->setCost(14);

        return sprintf(
            '                \'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $bcrypt->create($basePass)
        ).PHP_EOL;
    }

    public function getControllerPreValidate()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
            if (empty(\$post['$elementName'***REMOVED***) && empty(\$post['{$elementName}Verify'***REMOVED***)) {
                \$formInputFilter = \$form->getInputFilter();
                \$formInputFilter->remove('$elementName');
                \$formInputFilter->remove('{$elementName}Verify');
                \$form->setInputFilter(\$formInputFilter);
                unset(\$post['$elementName'***REMOVED***);
                unset(\$post['{$elementName}Verify'***REMOVED***);
            }

EOS;
        return $element;
    }

    public function getControllerPreShow()
    {
        $elementName = $this->str('class', $this->column->getName());
        $element = <<<EOS
            \$data->set$elementName('');

EOS;
        return $element;

    }

    public function getService()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        if (!empty(\$data['$elementName'***REMOVED***)) {
            \$bcrypt = new \Zend\Crypt\Password\Bcrypt();
            \$bcrypt->setCost(14);
            \$data['$elementName'***REMOVED*** = \$bcrypt->create(\$data['$elementName'***REMOVED***);
        } else {
            unset(\$data['$elementName'***REMOVED***);
        }

EOS;

        return $element;
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
            'required'   => $required,
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
            'required'   => $required,
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