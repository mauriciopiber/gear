<?php
namespace Gear\Column;

use Gear\Service\AbstractJsonService;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\UniqueInterface;

abstract class AbstractColumn extends AbstractJsonService implements UniqueInterface
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

    protected $column;

    protected $serviceLocator;




    public function __construct(ColumnObject $column)
    {
        $this->setColumn($column);
    }

    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value = $this->getFixtureDefault($numberReference);

        return <<<EOS
                '$name' => '$value',

EOS;
    }

    public function getColumnVar($column)
    {
        if (strlen($column->getName()) > 18) {
            $var = $this->str('var', substr($column->getName(), 0, 15));
        } else {
            $var = $this->str('var', $column->getName());
        }
        return $var;
    }


    /**
     *
     * @return string
     */
    public function getFixtureDatabase($number)
    {
        return sprintf(
            '%s',
            sprintf('%s%02d', $this->str('var', $this->column->getName()), $number)
        );
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function setColumn(ColumnObject $column)
    {
        $this->column = $column;
        return $this;
    }
/*
    public function getAcceptanceTestSeeValue($numberReference)
    {
        $value = $this->getFixtureDefault($numberReference);

        $value = substr($value, 0, $this->column->getCharacterMaximumLength());

        return <<<EOS
        \$I->see('$value');

EOS;
    }

    public function getAcceptanceTestSeeLabel()
    {
        $label = $this->str('label', $this->column->getName());

        return <<<EOS
        \$I->see('$label');

EOS;
    }

    public function getAcceptanceTestSeeInField($numberReference)
    {
        $module = $this->getModule()->getModuleName();
        $class = $this->str('class', $this->column->getTableName());
        $column = $this->str('var', $this->column->getName());
        $value = $this->getFixtureDefault($numberReference);
        $value = substr($value, 0, $this->column->getCharacterMaximumLength());

        return <<<EOS
        \$I->seeInField({$class}EditPage::\${$column}, '$value');

EOS;
    }

    public function getAcceptanceTestFillField($numberReference)
    {
        $module = $this->getModule()->getModuleName();
        $class = $this->str('class', $this->column->getTableName());
        $column = $this->str('var', $this->column->getName());
        $value = $this->getFixtureDefault($numberReference);
        $value = substr($value, 0, $this->column->getCharacterMaximumLength());


        return <<<EOS
        \$I->fillField({$class}EditPage::\${$column}, '$value');

EOS;

    }
*/
    /**
     * Função principal usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     */
    public function getViewColumnLayout($label, $value)
    {
        $value = <<<EOS
                             <tr>
                                 <td>
                                     <?php echo \$this->translate('{$label}');?>
                                 </td>
                                 <td>
                                     <?php echo \$this->escapeHtml({$value});?>
                                 </td>
                             </tr>

EOS;

        return $value;
    }

    /**
     * Função default que será chamado em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     * caso não esteja declarada a função nas classes filhas.
     */
    public function getViewData()
    {
        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->%s', $this->str('var', $this->column->getName()))
        );
    }


    public function getBaseMessage($base, $whitespace = false, $isPrimaryKey = false)
    {
        if ($whitespace) {
            $data = '%s %s';
        } else {
            $data = '%s%s';
        }

        if ($isPrimaryKey) {
            $baseMessage = $base;
        } else {
            $baseMessage = sprintf($data, $base, $this->str('label', $this->column->getName()));
        }

        if (
            strlen($baseMessage) > $this->column->getCharacterMaximumLength() &&
            $this->column->getDataType() == 'varchar'
        ) {
            $baseMessage = substr($baseMessage, 0, $this->column->getCharacterMaximumLength());
        }
        return $baseMessage;
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     * Função default que será chamada caso não esteja declarada nenhuma função de fixture nas classes filhas.
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \'%02d%s\',',
            $this->str('var', $this->column->getName()),
            $iterator,
            $this->str('label', $this->column->getName())
        ).PHP_EOL;
    }

    /**
     *
     * @return string
     */
    public function getFixtureDefault($number)
    {
        return sprintf(
            '%s',
            sprintf('%s%02d', $this->str('var', $this->column->getName()), $number)
        );
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getBaseMessage('insert', $this->column);

        $insert = <<<EOS
            '$columnVar' => '$columnValue',

EOS;
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
        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getBaseMessage('insert', $this->column);

        $insert = <<<EOS
            '$columnVar' => '$columnValue',

EOS;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de update dos dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumn()
    {
        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getBaseMessage('update', $this->column);

        $update = <<<EOS
            '$columnVar' => '$columnValue',

EOS;
        return $update;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     * Controller para assert com os dados do array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn()
    {
        $columnClass = $this->str('class', $this->column->getName());
        $columnValue = $this->getBaseMessage('insert', $this->column);

        $insertAssert = <<<EOS
        \$this->assertEquals('$columnValue', \$resultSet->get$columnClass());

EOS;
        return $insertAssert;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     * Controller para assert com os dados do array de atualização de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateAssertByColumn()
    {
        $columnClass = $this->str('class', $this->column->getName());
        $columnValue = $this->getBaseMessage('update', $this->column);

        $updateAssert = <<<EOS
        \$this->assertEquals('$columnValue', \$resultSet->get$columnClass());

EOS;
        return $updateAssert;
    }

    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     */
    public function getFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \${$var} = new Element('{$elementName}');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'text',
            'class' => 'form-control'
        ));
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

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

    public function getIdFormElement()
    {
        return $this->str('var', $this->column->getName());
    }

    public function filterUniqueElement()
    {
        $elementName = $this->column->getName();
        $elementLabel = $this->str('label', $this->column->getName());

        $elementClass = $this->str('var-lenght', 'id'.$this->str('class', $this->column->getTableName()));

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

    public function filterElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $name = '';
        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
            )
        );

EOS;

        return $element;
    }

    public function getFilterFormElement()
    {
        if ($this->getUniqueConstraint() !== false) {
            return $this->filterUniqueElement();
        }
        return $this->filterElement();
    }

    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $element = <<<EOS

                         <td>
                             <span ng-bind="{$tableVar}.{$elementName}"></span>
                         </td>

EOS;
        return $element;
    }
}
