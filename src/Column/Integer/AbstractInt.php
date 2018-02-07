<?php
namespace Gear\Column\Integer;

use Gear\Column\AbstractColumn;

/**
 *
 * Classe abstrata para todas Colunas Int
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
abstract class AbstractInt extends AbstractColumn
{
    protected $reference;

    /**
     * Retorna a referência atual utilizada pela classe
     *
     * @return int
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Adiciona uma referência para classe.
     *
     * @param int $reference Número Base
     *
     * @return \Gear\Column\Integer\AbstractInt
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
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
        \${$var} = new Element('$elementName');
        \${$var}->setLabel('$label');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'text',
            'class' => 'form-control integer'
        ));
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }
}
