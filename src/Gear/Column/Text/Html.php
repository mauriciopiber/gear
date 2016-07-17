<?php
namespace Gear\Column\Text;

use Gear\Column\Text\Text;

/**
 *
 * Classe para as colunas Texto com o plugin TinyMCE para editar HTML.
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
class Html extends Text
{
    public static $mvcFeatureNullTemplate = 'E eu vejo texto "" no campo html "%s"';
    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número base
     * @param int $line    Linha
     *
     * @return string
     */
    public function getIntegrationActionSendKeys($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu entro com o texto "{$value}" no campo html "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número base
     * @param int $line    Linha
     *
     * @return string
     */
    public function getIntegrationActionExpectValue($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu vejo texto "{$value}" no campo html "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Função usada para em \Gear\Service\Mvc\FormService::getFormInputValues
     *
     * @return string
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
