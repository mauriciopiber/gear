<?php
namespace Gear\Service\Column\Int;

use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Service\Column\Int;
use Gear\Service\Column\SearchFormInterface;

class ForeignKey extends Int implements SearchFormInterface
{
    protected $constraint;

    protected $helperStack;

    protected $moduleName;




    public function getAcceptanceTestSeeInField($numberReference)
    {
        $module = $this->getModule()->getModuleName();
        $class = $this->str('class', $this->column->getTableName());
        $column = $this->str('var', $this->column->getName());
        $value = $this->getFixtureDefault($numberReference);

        return <<<EOS
        \$I->seeOptionIsSelected(\\{$module}\Pages\\{$class}EditPage::\${$column}, $value);

EOS;
    }


    public function getAcceptanceTestFillField($numberReference)
    {

        $module = $this->getModule()->getModuleName();
        $class = $this->str('class', $this->column->getTableName());

        $column = $this->str('var', $this->column->getName());

        $value = $this->getFixtureDefault($numberReference);

        return <<<EOS
        \$I->selectOption(\\$module\Pages\\{$class}EditPage::\$$column, $value);

EOS;
    }

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
        $schema = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
        $referencedTable = $this->constraint->getReferencedTableName();

        $this->columns = $schema->getColumns($referencedTable);

        foreach ($this->columns as $a => $b) {

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
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
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
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
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
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de inserção de dados.
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

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de update dos dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumn()
    {
        $update = '            ';
        $update .= sprintf(
            '\'%s\' => \'%s\','.PHP_EOL,
            $this->str('var', $this->column->getName()),
            $this->helperStack['update'***REMOVED***
        );
        return $update;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de atualização de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateAssertByColumn()
    {
        $updateAssert = '        ';
        $updateAssert .= sprintf(
            '$this->assertEquals(\'%s\', $resultSet->get%s()->getId%s());'.PHP_EOL,
            $this->helperStack['update'***REMOVED***,
            $this->str('class', $this->column->getName()),
            $this->str('class', $this->getReferencedTableName())
        );
        return $updateAssert;
    }

	public function getConstraint() {
		return $this->constraint;
	}

	public function setConstraint($constraint) {
		$this->constraint = $constraint;
		return $this;
	}

	public function getHelperStack() {
		return $this->helperStack;
	}

	public function setHelperStack($helperStack) {
		$this->helperStack = $helperStack;
		return $this;
	}

	public function getReferencedTableValidColumnName()
	{
	    $schema = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
	    $referencedTable = $this->constraint->getReferencedTableName();

	    $this->columns = $schema->getColumns($referencedTable);

	    $validColumn = null;

	    foreach ($this->columns as $a => $b) {

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
	    $label       = $this->str('label', $this->column->getName());;

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
                'id' => '$elementName'
            ),
            'options' => array(
                'label' =>' $label',
                'object_manager' => \$this->getEntityManager(),
                'target_class' => '{$module}\Entity\\$entity',
                'property' => '{$property}',
                'empty_option' => 'Escolher:',
                'class' => 'form-control'
            ),
        );
        \$this->add(\${$var});

EOS;
	    return $element.PHP_EOL;
	}

	public function getSearchFormElement()
	{
	    $var         = $this->getColumnVar($this->column);
	    $label       = $this->str('label', $this->column->getName());;
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

	public function getModuleName() {
		return $this->moduleName;
	}

	public function setModuleName($moduleName) {
		$this->moduleName = $moduleName;
		return $this;
	}

	public function getViewListRowElement()
	{
	    $elementName = $this->str('var', $this->column->getName());

	    $entityFunction = $this->str('var', $this->getReferencedTableValidColumnName());

	    $element = <<<EOS
        <td>
            <?php echo (\$this->$elementName !== null) ? \$this->escapeHtml(\$this->{$elementName}['$entityFunction'***REMOVED***) : ''; ?>
        </td>

EOS;

	    return $element;
	}



}
