<?php
namespace Gear\Column\Text;

use Gear\Column\Text\Text;

class Html extends Text
{
    /**
     * Função usada para em \Gear\Service\Mvc\FormService::getFormInputValues
     */
    public function getFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \${$var} = new Element\Textarea('$elementName');
        \${$var}->setLabel('$label');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'textarea',
            'class' => 'form-control simple',
        ));
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }
}
