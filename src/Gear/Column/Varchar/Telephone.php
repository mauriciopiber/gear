<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;
use Gear\Column\UniqueInterface;

/**
 *
 * Classe que cria colunas com formato de Telefone
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
class Telephone extends Varchar implements UniqueInterface
{

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
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                     array(
                        'name' => 'Regex',
                        'options' =>  array(
                            'pattern'   => '/^(\([0-9***REMOVED***{2}\))\s([9***REMOVED***{1})?([0-9***REMOVED***{4})-([0-9***REMOVED***{4})$/',
                            'messages'  => [
                                \Zend\Validator\Regex::INVALID =>'Informe um telefone no formato válido'
                            ***REMOVED***
                        )
                    )
                )
            )
        );

EOS;

        return $element;
    }



    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
    *
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getValueFormat(15);

        $insert = <<<EOS
            '$columnVar' => '$columnValue',

EOS;
        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
    *
     * @return string Texto para inserir no template
     */
    public function getInsertSelectByColumn()
    {
        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getValueFormat(15);

        $insert = <<<EOS
            '$columnVar' => '$columnValue',

EOS;

        return $insert;
    }


    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para assert com os dados do array de inserção de dados.
    *
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn()
    {
        $columnClass = $this->str('class', $this->column->getName());
        $columnValue = $this->getValueFormat(15);

        $insertAssert = <<<EOS
        \$this->assertEquals('$columnValue', \$resultSet->get$columnClass());

EOS;
        return $insertAssert;
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
        unset($iterator);
        return '(51) 9999-99%02d';
    }

    /**
     * Formata o valor de saida
     *
     * @param int $number Número base
     *
     * @return string
     */
    public function getValueFormat($number)
    {
        return '(51) 9999-99'.sprintf('%02d', $number);
    }

    /*
     * Cria um ítem padrão para a Coluna utilizar em assert/select/array
     *
    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value = $this->getValueFormat($numberReference);

        return <<<EOS
                '$name' => '$value',

EOS;
    }
    */


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
            $this->getValueFormat($iterator)
        ).PHP_EOL;
    }

    /*
     *
     * @return string

    public function getFixtureDatabase($number)
    {
        return sprintf(
            '%s',
            sprintf('%s%02d', $this->str('var', $this->column->getName()), $number)
        );
    }

     *
     * @return string
     *
    public function getFixtureFormat($number)
    {
        return sprintf(
            '\'%s\'',
            $this->getValueFormat($number)
        );
    }
    */
}
