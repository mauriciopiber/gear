<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;
use Gear\Service\Column\UniqueInterface;

class Email extends Varchar implements UniqueInterface
{
    protected $uniqueConstraint;

    public function setUniqueConstraint($uniqueConstraint)
    {
        $this->uniqueConstraint = $uniqueConstraint;
        return $this;
    }

    public function getUniqueConstraint()
    {
        return $this->uniqueConstraint;
    }

    public function getFilterFormElement()
    {
        if ($this->getUniqueConstraint() !== false) {
            return $this->filterUniqueElement();
        }
        return $this->filterElement();
    }

    public function getAcceptanceTestSeeInField($numberReference)
    {
        $module = $this->getModule()->getModuleName();
        $class = $this->str('class', $this->column->getTableName());
        $column = $this->str('var', $this->column->getName());
        $value = $this->getValueFormat($numberReference);

        return <<<EOS
        \$I->seeInField(\\{$module}\Pages\\{$class}EditPage::\${$column}, '$value');

EOS;
    }

    public function getAcceptanceTestFillField($numberReference)
    {
        $module = $this->getModule()->getModuleName();
        $class = $this->str('class', $this->column->getTableName());
        $column = $this->str('var', $this->column->getName());
        $value = $this->getValueFormat($numberReference);


        return <<<EOS
        \$I->fillField(\\{$module}\Pages\\{$class}EditPage::\${$column}, '$value');

EOS;

    }


    public function filterUniqueElement()
    {
        $elementName = $this->column->getName();
        $elementLabel = $this->str('label', $this->column->getName());

        $elementClass = $this->str('class', $this->column->getTableName());

        $tableName  = $this->column->getTableName();
        $tableLabel = $this->str('label', $this->column->getTableName());

        $primaryKey = 'id_'.$this->str('uline', $this->column->getTableName());

        $name = '';
        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    \$this->getEmailAddressValidator('$elementLabel'),
                    \$this->getNoRecordExistValidator('$tableLabel', '$elementLabel', '$tableName', '$elementName', '$primaryKey', \$id{$elementClass})
                )
            )
        );

EOS;
        return $element;
    }

    public function filterElement()
    {
        $elementName = $this->str('var', $this->column->getName());
        $elementLabel = $this->str('label', $this->column->getName());

        $name = '';
        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    \$this->getEmailAddressValidator('$elementLabel')
                )
            )
        );

EOS;

        return $element;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
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
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
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
     * Usado nos testes unitários de Repository, Service, Controller para array de update dos dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumn()
    {
        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getValueFormat(25);

        $update = <<<EOS
            '$columnVar' => '$columnValue',

EOS;
        return $update;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de inserção de dados.
     * @param array $this->column Colunas válidas.
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
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de atualização de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateAssertByColumn()
    {
        $columnClass = $this->str('class', $this->column->getName());
        $columnValue = $this->getValueFormat(25);

        $updateAssert = <<<EOS
        \$this->assertEquals('$columnValue', \$resultSet->get$columnClass());

EOS;
        return $updateAssert;
    }


    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            sprintf('%s%02d%s',  $this->str('point', $this->column->getName()), $iterator, '@gmail.com')
        ).PHP_EOL;
    }

    public function getValueFormat($number)
    {
        return sprintf('%s%02d%s',  $this->str('point', $this->column->getName()),  $number, '@gmail.com');
    }

    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value = $this->getValueFormat($numberReference);

        return <<<EOS
                '$name' => '$value',

EOS;
    }


    public function getAcceptanceTestSeeValue($numberReference)
    {
        $value = $this->getValueFormat($numberReference);

        return <<<EOS
        \$I->see('$value');

EOS;
    }

    /**
     *
     * @return string
     */
    public function getFixtureDatabase($number)
    {
        return sprintf(
            '%s',
            sprintf('%s%02d',  $this->str('var', $this->column->getName()), $number)
        );
    }


    /**
     *
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
