<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;
use Gear\Column\UniqueInterface;

/**
 *
 * Classe que cria colunas para campos Url
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
class Url extends Varchar implements UniqueInterface
{


   /**
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string Formato utilizado para Database
     */
    public function getValueDatabase($iterator)
    {
        return sprintf('%s%02d%s', $this->str('point', $this->column->getName()), $iterator, '.com.br');
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
        return sprintf('%s%02d%s', $this->str('point', $this->column->getName()), $iterator, '.com.br');
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
            'class' => 'form-control'
        ));
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    /**
     * Retorna html utilizado nos Forms em Gear\Mvc\View\ViewService
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

EOS;
        return $element;
    }

    /**
     * Retorna filtro básico para as colunas em Gear\Mvc\Filter\FilterService
     *
     * @return string
     */
    public function filterElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$message = 'O valor é inválido';
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    [
                        'name' => 'Hostname',
                        'options' => [
                            'messages' => [
                                \Zend\Validator\Hostname::CANNOT_DECODE_PUNYCODE  => \$message,
                                \Zend\Validator\Hostname::INVALID                 => \$message,
                                \Zend\Validator\Hostname::INVALID_DASH            => \$message,
                                \Zend\Validator\Hostname::INVALID_HOSTNAME        => \$message,
                                \Zend\Validator\Hostname::INVALID_HOSTNAME_SCHEMA => \$message,
                                \Zend\Validator\Hostname::INVALID_LOCAL_NAME      => \$message,
                                \Zend\Validator\Hostname::INVALID_URI             => \$message,
                                \Zend\Validator\Hostname::IP_ADDRESS_NOT_ALLOWED  => \$message,
                                \Zend\Validator\Hostname::LOCAL_NAME_NOT_ALLOWED  => \$message,
                                \Zend\Validator\Hostname::UNDECIPHERABLE_TLD      => \$message,
                                \Zend\Validator\Hostname::UNKNOWN_TLD             => \$message
                            ***REMOVED***
                        ***REMOVED***
                    ***REMOVED***
                )
            )
        );

EOS;

        return $element;
    }

    /**
     * Retorna filtro para colunas únicas em Gear\Mvc\Filter\FilterService
     *
     * @return string
     */
    public function filterUniqueElement()
    {

        $elementName = $this->column->getName();

        $columnName = $this->str('var', $elementName);

        $elementLabel = $this->str('label', $this->column->getName());

        $elementClass = $this->str('var-length', 'id'.$this->str('class', $this->column->getTableName()));

        $tableName  = $this->column->getTableName();
        $tableLabel = $this->str('label', $this->column->getTableName());

        $primaryKey = 'id_'.$this->str('uline', $this->column->getTableName());

        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$message = 'O valor é inválido';
        \$this->add(
            array(
                'name' => '$columnName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    [
                        'name' => 'Hostname',
                        'options' => [
                            'messages' => [
                                \Zend\Validator\Hostname::CANNOT_DECODE_PUNYCODE  => \$message,
                                \Zend\Validator\Hostname::INVALID                 => \$message,
                                \Zend\Validator\Hostname::INVALID_DASH            => \$message,
                                \Zend\Validator\Hostname::INVALID_HOSTNAME        => \$message,
                                \Zend\Validator\Hostname::INVALID_HOSTNAME_SCHEMA => \$message,
                                \Zend\Validator\Hostname::INVALID_LOCAL_NAME      => \$message,
                                \Zend\Validator\Hostname::INVALID_URI             => \$message,
                                \Zend\Validator\Hostname::IP_ADDRESS_NOT_ALLOWED  => \$message,
                                \Zend\Validator\Hostname::LOCAL_NAME_NOT_ALLOWED  => \$message,
                                \Zend\Validator\Hostname::UNDECIPHERABLE_TLD      => \$message,
                                \Zend\Validator\Hostname::UNKNOWN_TLD             => \$message
                            ***REMOVED***
                        ***REMOVED***
                    ***REMOVED***,
                    \$this->getNoRecordExistValidator(
                        '$tableLabel',
                        '$elementLabel',
                        '$tableName',
                        '$elementName',
                        '$primaryKey',
                        \${$elementClass}
                    )
                )
            )
        );

EOS;
        return $element;
    }

    /**
     * Formata a saida para ser utizada em Gear\Mvc\Fixture\FixtureService
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getFixture()
     *
     * @param int $iterator Número base.
     *
     * @return string
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $this->getValue($iterator)
        ).PHP_EOL;
    }
}
