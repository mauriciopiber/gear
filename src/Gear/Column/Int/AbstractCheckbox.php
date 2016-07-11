<?php
namespace Gear\Column\Int;

use Gear\Column\Int\AbstractInt;

class AbstractCheckbox extends AbstractInt
{

    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $element = <<<EOS
                        <td>
                            <span ng-bind="{$tableVar}.{$elementName} | YesNo"></span>
                        </td>

EOS;
        return $element;
    }

    public function getMatchReference()
    {
        return ($this->getReference()%2==0) ? 1 : 0;
    }

    public function getValue($iterator)
    {
        return ($iterator%2==0) ? 'Não' : 'Sim';
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        $int = ($iterator%2==0) ? 0 : 1;

        $columnName = $this->str('var', $this->column->getName());
        $template = '                \'%s\' => \'%d\',';

        return sprintf($template, $columnName, $int).PHP_EOL;
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
     * Função default que será chamado em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     * caso não esteja declarada a função nas classes filhas.
     */
    public function getViewData()
    {

        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->yesOrNot($this->%s)', $this->str('var', $this->column->getName()))
        );
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
