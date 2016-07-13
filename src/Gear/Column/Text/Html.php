<?php
namespace Gear\Column\Text;

use Gear\Column\Text\Text;

class Html extends Text
{

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param ColumnObject $column
     */
    public function getIntegrationActionSendKeys($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu entro com o texto "{$value}" no campo html "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param ColumnObject $column
     */
    public function getIntegrationActionExpectValue($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu vejo texto "{$value}" no campo html "{$attribute}"

EOS;
        return $view;
    }

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
