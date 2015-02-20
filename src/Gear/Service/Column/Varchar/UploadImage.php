<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;

class UploadImage extends Varchar
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'varchar') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     */
    public function getFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());;


        $element = <<<EOS
        \${$var} = new Element\File('$elementName');
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
            <?php echo \$this->formLabel(\$form->get('$elementName')); ?>
            <?php echo \$this->formFile(\$form->get('$elementName')); ?>
            <?php echo \$this->formElementErrors(\$form->get('$elementName')); ?>
        </div>
        <div class="form-group">
            <?php if (\$this->$elementName) : ?>
                <img src="<?php echo \$this->$elementName;?>" height="100" width="100"/>
            <?php endif;?>
        </div>
EOS;
        return $element;
    }
}
