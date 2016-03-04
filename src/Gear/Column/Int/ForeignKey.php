<?php
namespace Gear\Column\Int;

use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\Int\Int;
use Gear\Column\Mvc\SearchFormInterface;

class ForeignKey extends Int implements SearchFormInterface
{
    protected $constraint;

    protected $helperStack;

    protected $moduleName;

    public function __construct(ColumnObject $column, ConstraintObject $constraint)
    {
        if ($column->getDataType() !== 'int') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }



        if (
            $constraint->getType() !== 'FOREIGN KEY'
            || !in_array($column->getName(), $constraint->getColumns())
        ) {
            throw new \Gear\Exception\InvalidForeignKeyException();
        }


        parent::__construct($column);

        $this->constraint = $constraint;
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => $this->getReference(\'%s-%d\'),',
            $this->str('var', $this->column->getName()),
            $this->str('url', $this->constraint->getReferencedTableName()),
            $iterator
        ).PHP_EOL;
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureUser($iterator)
    {
        if ($iterator > 0 && $iterator <= 5) {
            $iteratorUser = 1;
        } elseif ($iterator > 5 && $iterator <= 10) {
            $iteratorUser = 2;
        } elseif ($iterator > 10 && $iterator <= 15) {
            $iteratorUser = 3;
        } elseif ($iterator > 15 && $iterator <= 20) {
            $iteratorUser = 4;
        } elseif ($iterator > 20 && $iterator <= 25) {
            $iteratorUser = 5;
        } else {
            $iteratorUser = 6;
        }

        return sprintf(
            '                \'%s\' => $this->getReference(\'usuariogear%d\'),',
            $this->str('var', $this->column->getName()),
            $iteratorUser
        ).PHP_EOL;
    }

    public function getSchema()
    {

    }


    public function getFixtureDefault($number)
    {

        return 1;
    }

    public function getReferencedTableName()
    {
        return $this->constraint->getReferencedTableName();
    }

    /**
     * Função usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     */
    public function getViewData()
    {
        $schema = $this->getMetadata();
        $referencedTable = $this->constraint->getReferencedTableName();

        $this->columns = $schema->getColumns($referencedTable);

        foreach ($this->columns as $b) {

            if ($b->getDataType() == 'varchar') {
                $get = $this->str('class', $b->getName());
                break;
            }

        }
        if (!isset($get)) {
            $get = $this->str('class', $this->column->getName());
        }

        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->%s->get%s()', $this->str('var', $this->column->getName()), $get)
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
        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => \'%d\','.PHP_EOL,
            $this->str('var', $this->column->getName()),
            $this->helperStack['insert'***REMOVED***
        );

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
            '\'%s\' => \'%d\','.PHP_EOL,
            $this->str('var', $this->column->getName()),
            $this->helperStack['insert'***REMOVED***
        );

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     * Controller para assert com os dados do array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn()
    {
        $insertAssert = '        ';

        $insertAssert .= sprintf(
            '$this->assertEquals(\'%s\', $resultSet->get%s()->getId%s());'.PHP_EOL,
            $this->helperStack['insert'***REMOVED***,
            $this->str('class', $this->column->getName()),
            $this->str('class', $this->getReferencedTableName())
        );

        return $insertAssert;
    }


    public function getConstraint()
    {
        return $this->constraint;
    }

    public function setConstraint($constraint)
    {
        $this->constraint = $constraint;
        return $this;
    }

    public function getHelperStack()
    {
        return $this->helperStack;
    }

    public function setHelperStack($helperStack)
    {
        $this->helperStack = $helperStack;
        return $this;
    }

    public function getReferencedTableValidColumnName()
    {
        $schema = $this->getMetadata();
        $referencedTable = $this->constraint->getReferencedTableName();

        $this->columns = $schema->getColumns($referencedTable);

        $validColumn = null;

        foreach ($this->columns as $b) {

            if ($b->getDataType() == 'varchar') {
                $validColumn = $this->str('class', $b->getName());
                break;
            }
        }

        return $validColumn;
    }


    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     */
    public function getFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $module = $this->getModuleName();
        $entity = $this->str('class', $this->getReferencedTableName());

        $column = $this->getReferencedTableValidColumnName();

        if ($column === null) {
            $column = 'id.'.$this->str('class', $entity);
        }

        $property = $this->str('var', $column);


        $element = <<<EOS
        \${$var} = array(
            'name' => '$elementName',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'attributes' => array(
                'id' => '$elementName',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => '$label',
                'object_manager' => \$this->getEntityManager(),
                'target_class' => '{$module}\Entity\\$entity',
                'property' => '{$property}',
                'empty_option' => 'Escolher:'
            ),
        );
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    public function getSearchFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $label       = $this->str('label', $this->column->getName());
        $elementName = $this->str('var', $this->column->getName());

        $module = $this->getModuleName();

        $entity = $this->str('class', $this->getReferencedTableName());
        $entityFunction = $this->str('var', $this->getReferencedTableValidColumnName());

        $element = <<<EOS

        \${$var} = array(
            'name' => '$elementName',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => '$label',
                'object_manager' => \$this->getEntityManager(),
                'target_class' => '$module\Entity\\$entity',
                'property' => '$entityFunction',
                'empty_option' => 'Escolher:',
            ),
        );
        \$this->add(\${$var});

EOS;

        return $element;
    }

    public function getSearchViewElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS

        <div class="col-lg-12">
            <div class="form-group">
                <?php \$this->formRow(\$form->get('$elementName')); ?>
            </div>
        </div>
EOS;
        return $element;
    }

    public function getModuleName()
    {
        return $this->moduleName;
    }

    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
        return $this;
    }

    public function getViewListRowElement()
    {
        $elem = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $enti = $this->str('var', $this->getReferencedTableValidColumnName());

        $php = "<span ng-bind=\"{$tableVar}.{$elem} != '' ? {$tableVar}.{$elem}.{$enti} : ''\"></span>";

        $element = <<<EOS

                         <td>
                             $php
                         </td>

EOS;

        return $element;
    }
}
