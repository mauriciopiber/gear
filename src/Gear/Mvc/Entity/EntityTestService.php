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
namespace Gear\Mvc\Entity;

use Gear\Mvc\AbstractMvc;
use GearJson\Db\Db;
use GearJson\Src\Src;
use Gear\Column\Int\ForeignKey;

class EntityTestService extends AbstractMvc
{
    protected $mockColumns;

    public function introspectFromTable(Db $db)
    {
        $this->db = $db;
        return $this->createDb();
    }

    public function create(Src $src)
    {
        $this->src = $src;
        $this->db = $src->getDb();
        return $this->createDb();
    }

    public function createDb()
    {
        //$metadata = $this->getMetadata();
        $this->tableName = $this->str('uline', $this->db->getTable());
        //$this->table = new \Gear\Table\TableService\Table($metadata->getTable());
        $this->tableColumns = $this->getColumnService()->getColumns($this->db, true);

        $assertNull = $this->getTestGettersNull();
        $assertSet  = $this->getTestSetters();

        return $this->getFileCreator()->createFile(
            'template/module/mvc/entity-test/src.entity.phtml',
            array(
                'serviceNameUline' => $this->str('var-lenght', $this->tableName),
                'serviceNameClass'   => $this->str('class', $this->tableName),
                'module'  => $this->getModule()->getModuleName(),
                'assertNull' => $assertNull,
                'assertSet'  => $assertSet,
                'params' => $this->getParams(),
                'provider' => $this->getProvider(),
                'mocks' => $this->getMocks()
            ),
            $this->str('class', $this->tableName).'Test.php',
            $this->getModule()->getTestEntityFolder()
        );
    }

    public function getClassMethods()
    {
        $methods = get_class_methods(
            sprintf(
                '\%s\\Entity\\%s',
                $this->getModule()->getModuleName(),
                $this->str('class', $this->tableName)
            )
        );

        if (!empty($methods)) {
            return $methods;
        }
        return array();
    }

    public function getExtraGetter($useMethods)
    {

        $classMethods = $this->getClassMethods();

        $moreMethods = array_diff($classMethods, $useMethods);


        $filter = function ($value) {
            if (substr($value, 0, 3) === 'get') {
                return true;
            } else {
                return false;
            }
        };

        return array_filter($moreMethods, $filter);
    }

    public function getTestGettersNull()
    {
        $assertNull = [***REMOVED***;

        $useMethods = [***REMOVED***;

        foreach ($this->tableColumns as $columnData) {
            $column = $columnData->getColumn();
            $method = sprintf('get%s', $this->str('class', $column->getName()));

            $useMethods[***REMOVED*** = $method;
            $assertNull[***REMOVED*** = sprintf('$this->assertNull($this->entity->%s());', $method);
        }

        $moreMethodsUse = $this->getExtraGetter($useMethods);

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $method) {
                $assertNull[***REMOVED*** = sprintf(
                    '$this->assertInstanceOf(\'Doctrine\Common\Collections\ArrayCollection\',$this->entity->%s());',
                    $method
                );
            }
        }
        return $assertNull;
    }

    /**
     * Used by $entity->testGetterInitiateByNull()
     *
     * @return string[***REMOVED***
     */
    public function getTestSetters()
    {
        $primaryKeyColumn = $this->getTableService()->getPrimaryKeyColumns($this->str('uline', $this->tableName));

        $assertNull = [***REMOVED***;

        foreach ($this->tableColumns as $columnData) {
            $column = $columnData->getColumn();

            if (in_array($column->getName(), $primaryKeyColumn)) {
                continue;
            }


            if ($columnData instanceof ForeignKey) {
                $assertNull[***REMOVED*** = sprintf(
                    '$this->entity->set%s($%s);',
                    $this->str('class', $column->getName()),
                    $this->str('var-lenght', $column->getName())
                );

                $assertNull[***REMOVED*** = sprintf(
                    '$this->assertEquals($%s, $this->entity->get%s());'.PHP_EOL,
                    $this->str('var-lenght', $column->getName()),
                    $this->str('class', $column->getName())
                );

                continue;
            }
            $assertNull[***REMOVED*** = sprintf(
                '$this->entity->set%s($%s);',
                $this->str('class', $column->getName()),
                $this->str('var-lenght', $column->getName())
            );
            $assertNull[***REMOVED*** = sprintf(
                '$this->assertEquals($%s, $this->entity->get%s());'.PHP_EOL,
                $this->str('var-lenght', $column->getName()),
                $this->str('class', $column->getName())
            );
        }

        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {
                $classId    = str_replace('add', '', $newMock);

                $assertNull[***REMOVED*** = sprintf(
                    '$this->entity->add%s($%s);',
                    $this->str('class', $classId),
                    $this->str('var-lenght', $classId)
                );
                $assertNull[***REMOVED*** = sprintf(
                    '$this->entity->remove%s($%s);',
                    $this->str('class', $classId),
                    $this->str('var-lenght', $classId)
                );
            }
        }
        //var_dump($moreMethodsUse);


        return $assertNull;
    }

    public function getExtraSetter()
    {
        $classMethods = $this->getClassMethods();


        $filter = function ($value) {
            if (substr($value, 0, 3) === 'add') {
                return true;
            } else {
                return false;
            }
        };

        return array_filter($classMethods, $filter);
    }


    public function getProvider()
    {
        $dataProvider = [***REMOVED***;

        $primaryKeyColumn = $this->getTableService()->getPrimaryKeyColumns($this->tableName);

        foreach ($this->tableColumns as $columnData) {
            $column = $columnData->getColumn();

            if (in_array($this->str('uline', $column->getName()), $primaryKeyColumn)) {
                continue;
            }

            if ($columnData instanceof ForeignKey) {
                $foreignKey = $this->getTableService()->getConstraintForeignKeyFromColumn($this->tableName, $column);

                $referencedTable = $foreignKey->getReferencedTableName();

                $columName = $this->str('class', $referencedTable). $this->str('class', $column->getName());

                $dataProvider[***REMOVED*** = sprintf('                $%s', $this->str('var-lenght', $columName));

                $this->mockColumns[***REMOVED*** = $columnData;

                continue;

            }

            $dataProvider[***REMOVED*** = '                \''.$this->str('label', $column->getName()).'\'';
        }

        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {
                $classId    = str_replace('add', '', $newMock);
                $dataProvider[***REMOVED*** = sprintf('                $%s', $this->str('var-lenght', $classId));
            }
        }



        return $dataProvider;
    }

    public function getMocks()
    {

        $mocks = [***REMOVED***;

        if (count($this->mockColumns)>0) {
            foreach ($this->mockColumns as $columnData) {

                $column = $columnData->getColumn();

                if (!($columnData instanceof ForeignKey)) {
                    continue;
                }

                $refObject = $this->getTableService()->getConstraintForeignKeyFromColumn($this->tableName, $column);

                if ($refObject === false) {
                    continue;
                }

                $refTable = $refObject->getReferencedTableName();

                $mock = '        ';

                $columnName = $this->str('class', $refTable).$this->str('class', $column->getName());

                $mock .= sprintf('$%s = ', $this->str('var-lenght', $columnName));

                $mockModule = (in_array($refTable, array('user', 'User')))
                  ? 'GearAdmin'
                  : $this->getModule()->getModuleName();

                $mock .= sprintf(
                    '$this->prophesize(\'%s\\Entity\\%s\')->reveal();',
                    $mockModule,
                    $this->str('class', $refTable)
                ).PHP_EOL;
                $mocks[***REMOVED*** = $mock;
            }
        }

        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {
                $clearClass = str_replace('add', '', $newMock);
                $classId    = str_replace('addId', '', $newMock);

                $mock = '        ';
                $mock .= sprintf('$%s = ', $this->str('var-lenght', $clearClass));
                $mock .= sprintf(
                    '$this->prophesize(\'%s\\Entity\\%s\')->reveal();',
                    $this->getModule()->getModuleName(),
                    $this->str('class', $classId)
                ).PHP_EOL;
                $mocks[***REMOVED*** = $mock;
            }
        }

        return $mocks;
    }


    public function getParams()
    {
        $primaryKeyColumn = $this->getTableService()->getPrimaryKeyColumns($this->tableName);

        $params = [***REMOVED***;

        foreach ($this->tableColumns as $columnData) {

            $column = $columnData->getColumn();

            if ($columnData instanceof PrimaryKey) {
                continue;
            }

            if ($columnData instanceof ForeignKey) {
                //$referencedTable = $foreignKey->getReferencedTableName();

                $params[***REMOVED*** = sprintf('        $%s', $this->str('var-lenght', $column->getName()));

                continue;
            }

            $params[***REMOVED*** = sprintf('        $%s', $this->str('var-lenght', $column->getName()));
        }

        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {
                $classId    = str_replace('add', '', $newMock);
                $params[***REMOVED*** = sprintf('        $%s', $this->str('var-lenght', $classId));
            }
        }

        return $params;
    }
}
