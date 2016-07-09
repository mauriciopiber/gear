<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;
use Gear\Column\UniqueInterface;

class Url extends Varchar implements UniqueInterface
{
    /**
     * Cria um ítem padrão para a Coluna utilizar em assert/select/array
     *
     */
    public function getValueFormat($number)
    {
        return sprintf('%s%02d%s', $this->str('point', $this->column->getName()), $number, '.com.br');
    }

    public function getValue()
    {
        return sprintf('%s', $this->str('point', $this->column->getName())).'%02d'.sprintf('%s', '.com.br');
    }

    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value = $this->getValueFormat($numberReference);

        return <<<EOS
                '$name' => '$value',

EOS;
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
        \${$var} = new Element('$elementName');
        \${$var}->setLabel('$label');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'text',
            'class' => 'form-control'
        ));
        \$this->add(\${$var});

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

EOS;
        return $element;
    }

    public function filterElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    new \Zend\Validator\Hostname()
                )
            )
        );

EOS;

        return $element;
    }

    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $this->getValueFormat($iterator)
        ).PHP_EOL;
    }

    /**
     *
     * @return string
     */
    public function getFixtureDatabase($number)
    {
        return sprintf(
            '%s',
            sprintf('%s%02d', $this->str('var', $this->column->getName()), $number)
        );
    }

    /**
     * @return string
     */
    public function getFixtureFormat($number)
    {
        return sprintf(
            '\'%s\'',
            $this->getValueFormat($number)
        );
    }
}
