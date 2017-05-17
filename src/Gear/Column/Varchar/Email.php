<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;
use Gear\Column\UniqueInterface;

/**
 *
 * Classe que cria colunas para E-mail
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
class Email extends Varchar implements UniqueInterface
{
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
        $tableLabelUnique = $this->str('label', $this->column->getTableName());

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
                    array(
                        'name' => 'EmailAddress',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\EmailAddress::INVALID            => \$message,
                                \Zend\Validator\EmailAddress::INVALID_FORMAT     => \$message,
                                \Zend\Validator\EmailAddress::INVALID_HOSTNAME   => \$message,
                                \Zend\Validator\EmailAddress::INVALID_MX_RECORD  => \$message,
                                \Zend\Validator\EmailAddress::INVALID_SEGMENT    => \$message,
                                \Zend\Validator\EmailAddress::DOT_ATOM           => \$message,
                                \Zend\Validator\EmailAddress::QUOTED_STRING      => \$message,
                                \Zend\Validator\EmailAddress::INVALID_LOCAL_PART => \$message,
                                \Zend\Validator\EmailAddress::LENGTH_EXCEEDED    => \$message,
                            ),
                        ),
                        'break_chain_on_failure' => true
                    ),
                    \$this->getNoRecordExistValidator(
                        '$tableLabelUnique',
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
     * Retorna filtro básico para as colunas em Gear\Mvc\Filter\FilterService
     *
     * @return string
     */
    public function filterElement()
    {
        $elementName = $this->str('var', $this->column->getName());
        $elementLabel = $this->str('label', $this->column->getName());

        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$message = 'O valor é inválido';
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    array(
                        'name' => 'EmailAddress',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\EmailAddress::INVALID            => \$message,
                                \Zend\Validator\EmailAddress::INVALID_FORMAT     => \$message,
                                \Zend\Validator\EmailAddress::INVALID_HOSTNAME   => \$message,
                                \Zend\Validator\EmailAddress::INVALID_MX_RECORD  => \$message,
                                \Zend\Validator\EmailAddress::INVALID_SEGMENT    => \$message,
                                \Zend\Validator\EmailAddress::DOT_ATOM           => \$message,
                                \Zend\Validator\EmailAddress::QUOTED_STRING      => \$message,
                                \Zend\Validator\EmailAddress::INVALID_LOCAL_PART => \$message,
                                \Zend\Validator\EmailAddress::LENGTH_EXCEEDED    => \$message,
                            ),
                        ),
                        'break_chain_on_failure' => true
                    )
                )
            )
        );

EOS;

        return $element;
    }

    /**
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string Formato utilizado para Database
     */
    public function getValueDatabase($iterator)
    {
        return sprintf('%s%02d%s', $this->str('point', $this->column->getName()), $iterator, '@gmail.com');
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
        return sprintf('%s%02d%s', $this->str('point', $this->column->getName()), $iterator, '@gmail.com');
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
            sprintf('%s%02d%s', $this->str('point', $this->column->getName()), $iterator, '@gmail.com')
        ).PHP_EOL;
    }

    /**
     * Retorna o formáto esperado
     *
     * @param int $number Número base
     *
     * @return string
     */
    public function getValueFormat($number)
    {
        return sprintf('%s%02d%s', $this->str('point', $this->column->getName()), $number, '@gmail.com');
    }

    /**
     * Retorna o formáto esperado
     *
     * @param int $number
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
