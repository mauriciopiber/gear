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
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;

class EntityTestService extends AbstractJsonService
{
    public function createUnitTest($tableName)
    {
        $this->tableName = $tableName;

        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));
        $this->table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $this->tableName)));

        $assertNull = $this->getTestGettersNull();
        $assertSet  = $this->getTestSetters();

        $this->createFileFromTemplate(
            'template/test/unit/entity/src.entity.phtml',
            array(
                'serviceNameUline' => $this->str('var', $this->tableName),
                'serviceNameClass'   => $this->str('class', $this->tableName),
                'module'  => $this->getConfig()->getModule(),
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
        return get_class_methods(sprintf('\%s\\Entity\\%s', $this->getConfig()->getModule(), $this->str('class', $this->tableName)));
    }

    public function getExtraGetter($useMethods)
    {

        $classMethods = $this->getClassMethods();

        $moreMethods = array_diff($classMethods, $useMethods);


        $filter = function($value) {
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

        foreach ($this->tableColumns as $column) {

            $method = sprintf('get%s', $this->str('class', $column->getName()));

            $useMethods[***REMOVED*** = $method;
            $assertNull[***REMOVED*** = sprintf('$this->assertNull($entity->%s());', $method);
        }

        $moreMethodsUse = $this->getExtraGetter($useMethods);

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $method) {
                $assertNull[***REMOVED*** = sprintf('$this->assertInstanceOf(\'Doctrine\Common\Collections\ArrayCollection\',$entity->%s());', $method);
            }
        }
        return $assertNull;
    }

    public function getTestSetters()
    {
        $primaryKeyColumn = $this->table->getPrimaryKeyColumns();

        $assertNull = [***REMOVED***;
        $useMethods = [***REMOVED***;


        foreach ($this->tableColumns as $column) {

            if (in_array($column->getName(), $primaryKeyColumn))
                continue;

            if ($foreignKey = $this->table->getForeignKeyFromColumnObject($column)) {

                $referencedTable = $foreignKey->getReferencedTableName();

                $params[***REMOVED*** = sprintf('$mock%s', $this->str('class', $column->getName()));
                $assertNull[***REMOVED*** = sprintf('$entity->set%s($mock%s);', $this->str('class', $column->getName()), $this->str('class', $column->getName()));
                $assertNull[***REMOVED*** = sprintf('$this->assertEquals($mock%s, $entity->get%s());'.PHP_EOL, $this->str('class', $column->getName()), $this->str('class', $column->getName()));

                continue;
            }
            $assertNull[***REMOVED*** = sprintf('$entity->set%s($%s);', $this->str('class', $column->getName()), $this->str('var', $column->getName()));
            $assertNull[***REMOVED*** = sprintf('$this->assertEquals($%s, $entity->get%s());'.PHP_EOL, $this->str('var', $column->getName()), $this->str('class', $column->getName()));
        }

        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {

                $classId    = str_replace('add', '', $newMock);

                $assertNull[***REMOVED*** = sprintf('$entity->add%s($mock%s);', $this->str('class', $classId), $this->str('class', $classId));
                $assertNull[***REMOVED*** = sprintf('$entity->remove%s($mock%s);', $this->str('class', $classId), $this->str('class', $classId));
            }
        }
        //var_dump($moreMethodsUse);


        return $assertNull;
    }

    public function getExtraSetter()
    {
        $classMethods = $this->getClassMethods();


        $filter = function($value) {
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

        $primaryKeyColumn = $this->table->getPrimaryKeyColumns();

        foreach ($this->tableColumns as $column) {
            if (in_array($this->str('uline', $column->getName()), $primaryKeyColumn)) {
                continue;
            }

            if ($foreignKey = $this->table->getForeignKeyFromColumnObject($column)) {

                $referencedTable = $foreignKey->getReferencedTableName();
                $dataProvider[***REMOVED*** = sprintf('$mock%s%s', $this->str('class', $referencedTable), $this->str('class', $column->getName()));

                $this->mockColumns[***REMOVED*** = $column;

                continue;

            }
            $dataProvider[***REMOVED*** = '\''.$this->str('label', $column->getName()).'\'';
        }

        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {

                $classId    = str_replace('add', '', $newMock);
                $dataProvider[***REMOVED*** = sprintf('$mock%s', $this->str('class', $classId));

            }
        }



        return $dataProvider;
    }

    public function getMocks()
    {

        $mocks = [***REMOVED***;

        if (count($this->mockColumns)>0) {
            foreach ($this->mockColumns as $column) {


                $referencedTable = $this->table->getForeignKeyFromColumnObject($column)->getReferencedTableName();
                $mock = '        ';
                $mock .= sprintf('$mock%s%s = ', $this->str('class', $referencedTable), $this->str('class', $column->getName()));

                $mockModule = (in_array($referencedTable, array('user', 'User'))) ? 'Security' : $this->getConfig()->getModule();

                $mock .= sprintf('$this->getMockBuilder(\'%s\\Entity\\%s\')->getMock();', $mockModule, $this->str('class', $referencedTable)).PHP_EOL;
                $mocks[***REMOVED*** = $mock;

            }
        }

        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {

            foreach ($moreMethodsUse as $newMock) {

                $clearClass = str_replace('add', '', $newMock);
                $classId    = str_replace('addId', '', $newMock);

                $mock = '        ';
                $mock .= sprintf('$mock%s = ', $this->str('class', $clearClass));
                $mock .= sprintf('$this->getMockBuilder(\'%s\\Entity\\%s\')->getMock();', $this->getConfig()->getModule(), $this->str('class', $classId)).PHP_EOL;
                $mocks[***REMOVED*** = $mock;


            }

        }

        return $mocks;

    }


    public function getParams()
    {
        $primaryKeyColumn = $this->table->getPrimaryKeyColumns();

        $assertNull = [***REMOVED***;
        $params = [***REMOVED***;

        foreach ($this->tableColumns as $column) {

            if (in_array($column->getName(), $primaryKeyColumn)) {
                continue;
            }

            if ($foreignKey = $this->table->getForeignKeyFromColumnObject($column)) {

                $referencedTable = $foreignKey->getReferencedTableName();

                $params[***REMOVED*** = sprintf('$mock%s', $this->str('class', $column->getName()));

                continue;
            }

            $params[***REMOVED*** = sprintf('$%s', $this->str('var', $column->getName()));
        }

        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {

                $classId    = str_replace('add', '', $newMock);
                $params[***REMOVED*** = sprintf('$mock%s', $this->str('class', $classId));

            }
        }

        return $params;
    }




    public function introspectFromTable($table)
    {
        $class = $this->str('class', $table->getName());

        $this->createFileFromTemplate(
            'template/test/unit/entity/full.entity.phtml',
            array(
                'serviceNameUline' => $this->str('var', $class),
                'serviceNameClass'   => $class,
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'Test.php',
            $this->getModule()->getTestEntityFolder()
        );
    }
}
