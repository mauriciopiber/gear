<?php
namespace Gear\Column\Int;

use Gear\Column\Int\AbstractInt;

class AbstractCheckbox extends AbstractInt
{



    public function getMatchReference()
    {
        return ($this->getReference()%2==0) ? 1 : 0;
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        if ($iterator%2==0) {
            $int = 0;
        } else {
            $int = 1;
        }


        return sprintf(
            '                \'%s\' => \'%d\',',
            $this->str('var', $this->column->getName()),
            $int
        ).PHP_EOL;
    }

    public function getFixtureDefault($number)
    {
        return 1;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => %s,',
            $this->str('var', $this->column->getName()),
            sprintf('%d', $this->getMatchReference())
        ).PHP_EOL;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertSelectByColumn()
    {
        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => %s,',
            $this->str('var', $this->column->getName()),
            sprintf('%d', $this->getMatchReference())
        ).PHP_EOL;

        return $insert;
    }


    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para assert com os dados do array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn()
    {
        $insertAssert = '        ';
        $insertAssert .= sprintf(
            '$this->assertEquals(%s, $resultSet->get%s());',
            sprintf('%d', $this->getMatchReference()),
            $this->str('class', $this->column->getName())
        ).PHP_EOL;

        return $insertAssert;
    }



    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     */
    public function getFormElement()
    {
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \$this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => '$elementName',
            'options' => array(
                'label' => '$label',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
                'default_value' => '0'
            ),
            'attributes' => array(
                 'value' => '0',
                 'id' => '$elementName'
            )
        ));
EOS;
        return $element.PHP_EOL;
    }
}