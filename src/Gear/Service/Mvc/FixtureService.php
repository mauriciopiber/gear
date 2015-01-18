<?php
/**
 *
 * @author piber
 * Um serviço é o ítem mais importante do DDD.
 * Um serviço precisa ser testado com TDD.
 * Um serviço não possui interface então não precisa ser testado com codeception.
 * Um serviço pode extender outro serviço.
 * Um serviço precisa ser adicionado ao invokables do Module.php ao final do processo.
 *
 */
namespace Gear\Service\Mvc;

use Gear\Service\AbstractFixtureService;
use Gear\Common\SchemaToolServiceTrait;
use Gear\Common\SpecialityServiceTrait;

class FixtureService extends AbstractFixtureService
{

    use SchemaToolServiceTrait;
    use SpecialityServiceTrait;

    protected $speciality;

    protected $tableName;

    protected $srcName;

    protected $tableData;

    public function getTableData()
    {
        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');

        $table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $this->tableName)));

        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));

        $primaryKeyColumn = $table->getPrimaryKeyColumns();

        unset($this->validColumns);

        $defaultNamespace = 'Gear\\Service';

        foreach ($this->tableColumns as $column) {

            if (in_array($column->getName(), \Gear\ValueObject\Db::excludeList())) {
                continue;
            }


            $dataType = $this->str('class', $column->getDataType());

            $specialityName = $this->getGearSchema()->getSpecialityByColumnName($column->getName(), $this->tableName);


            $columnConstraint = $table->getForeignKeyFromColumn($column);

            //primary key
            if($primaryKeyColumn == $column->getName()) {

                if (!$this->usePrimaryKey) {
                    continue;
                }
                $class = $defaultNamespace.'\\'.$dataType.'\\PrimaryKey';

            //foreign key
            } elseif($columnConstraint !== null) {
                $class = $defaultNamespace.'\\'.$dataType.'\\ForeignKey';
            //standard
            } elseif ($specialityName == null) {
                $class = $defaultNamespace.'\\'.$dataType;

            //speciality
            } else {
                $class = $defaultNamespace.'\\'.$dataType.'\\'.$this->str('class', $specialityName);
            }
            $instance = new $class($column);
            var_dump($instance);
            $this->validColumns[***REMOVED***  = $column;
        }
        return $this->validColumns;
    }

    public function setColumnFixture($column, $iterator)
    {
        $columnConstraint = $this->table->getForeignKeyFromColumnObject($column);

        if (!$columnConstraint) {
            $text = sprintf('                \'%s\' => \'%d%s\',', $this->str('var', $column->getName()), $iterator, $this->str('label', $column->getName())).PHP_EOL;
        } else {
            $text = sprintf('                \'%s\' => $this->getReference(\'%s-%d\'),', $this->str('var', $column->getName()), $this->str('url', $columnConstraint->getReferencedTableName()), $iterator).PHP_EOL;
        }

        return $text;
    }

    /**
     *
     * @param unknown $tableName
     */
    public function instrospect()
    {
$this->getTableData();
die();

        $this->columns = $this->getValidColumnsFromTable();

        $arrayData = $this->getArrayData();

        $fieldsData = $this->getFieldData();


        $schemaTool = $this->getSchemaToolService();

        return $this->createFileFromTemplate(
            'template/src/fixture/default.phtml',
            array(
                'fields'  => $fieldsData,
                'data'   => $arrayData,
                'name'   => $this->srcName,
                'module'  => $this->getConfig()->getModule(),
                'order' => $schemaTool->getOrderNumber($this->str('uline', $this->tableName))
            ),
            $this->srcName.'.php',
            $this->getModule()->getFixtureFolder()
        );
    }

    public function calculateOrderFromDatabase()
    {

    }

    public function introspectFromTable($db)
    {
        $this->tableName   = $db->getTable();



        $src = $this->getGearSchema()->getSrcByDb($db, 'Fixture');
        $this->srcName = $src->getName();

        return $this->instrospect();
    }
    /**
     *
     * @param \Gear\ValueObject\Src $src
     */
    public function create($src)
    {
        $this->tableName = $src->getDb();

        $this->srcName = $src->getName();

        return $this->instrospect();
    }

    /**
     * @param string $tableName
     * @param array $columns
     */
    public function getFieldData()
    {
        $fields = [***REMOVED***;
        foreach ($this->columns as $field) {
            $fields[***REMOVED*** = sprintf('            $%s->set%s($fixture[\'%s\'***REMOVED***);', $this->str('var', $this->tableName), $this->str('class', $field->getName()), $this->str('var', $field->getName()));
        }
        return $fields;
    }

    /**
     * @param array $columns Colunas da Tabela que serão utilizadas na fixture.
     * @return array:string Valores que serão inseridos na fixture.
     */
    public function getArrayData()
    {
        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        $this->table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $this->tableName)));
        $arrayData = [***REMOVED***;
        for ($iterator = 1; $iterator <= 30; $iterator++) {
            $arrayData[***REMOVED*** = '            array('.PHP_EOL;
            foreach ($this->columns as $column) {
                $arrayData[***REMOVED*** = $this->setColumnFixture($column, $iterator);
            }
            $arrayData[***REMOVED*** = '            ),'.PHP_EOL;
        }
        return $arrayData;
    }

}
