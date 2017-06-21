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
use Gear\Column\Integer\ForeignKey;
use Gear\Column\Integer\PrimaryKey;

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
        $this->tableName = $this->str('uline', $this->db->getTable());
        $this->columnManager = $this->db->getColumnManager();

        $entityTestConfig = new EntityTestConfig(
            $this->getModule()->getModuleName(),
            $this->str('class', $this->tableName)
        );

        $this->createTestFieldsNullMethod($entityTestConfig);

        $this->createTestFieldsMethod($entityTestConfig);

        $this->createTestFieldsProviderMethod($entityTestConfig);

        return $this->getFileCreator()->createFile(
            'template/module/mvc/entity-test/src.entity.phtml',
            $entityTestConfig->export(),
            $this->str('class', $this->tableName).'Test.php',
            $this->getModule()->getTestEntityFolder()
        );
    }

    public function createTestFieldsProviderMethod(EntityTestConfig &$entityTestConfig)
    {
        $provider = $this->getProvider();
        $mocks = $this->getMocks();
        $entityTestConfig->setFieldsProviderMethod(
            $mocks,
            $provider
        );
    }

    public function createTestFieldsMethod(EntityTestConfig &$entityTestConfig)
    {
        $entityTestConfig->setFieldsMethod(
            $this->getParams(),
            $this->getTestSetters()
        );
    }

    public function createTestFieldsNullMethod(EntityTestConfig &$entityTestConfig)
    {
        //$assertNull = [***REMOVED***;

        //$useMethods = [***REMOVED***;

        $assertNull = $this->columnManager->extractCode('getEntityAssertNull', [***REMOVED***);

        /*
        //lista todas colunas
        foreach ($this->tableColumns as $columnData) {

        }
        */

        /*
        $moreMethodsUse = $this->getExtraGetter($useMethods);

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $method) {
                $assertNull[***REMOVED*** = sprintf(
                    '$this->assertInstanceOf(\'Doctrine\Common\Collections\ArrayCollection\',$this->entity->%s());',
                    $method
                );
            }
        }
        */

        $entityTestConfig->setFieldsNullMethod($assertNull);
    }

    /**
     * Used by $entity->testGetterInitiateByNull()
     *
     * @return string[***REMOVED***
     */
    public function getTestSetters()
    {
        //$testSetters = [***REMOVED***;
        return $this->columnManager->extractCode('getEntitySetter', [***REMOVED***, [
            \Gear\Column\Integer\PrimaryKey::class
        ***REMOVED***);

        /*
        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {
                $classId    = str_replace('add', '', $newMock);

                $assertNull[***REMOVED*** = sprintf(
                    '$this->entity->add%s($%s);',
                    $this->str('class', $classId),
                    $this->str('var-length', $classId)
                );
                $assertNull[***REMOVED*** = sprintf(
                    '$this->entity->remove%s($%s);',
                    $this->str('class', $classId),
                    $this->str('var-length', $classId)
                );
            }
        }
        //var_dump($moreMethodsUse);


        return $assertNull;
        */
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
        //$this->columnManager->extractCode('getEntityDataProvider', [***REMOVED***);
        return $this->columnManager->extractCode('getEntityDataProvider', [***REMOVED***);

        /*
        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {
                $classId    = str_replace('add', '', $newMock);
                $dataProvider[***REMOVED*** = sprintf('                $%s', $this->createVar($classId));
            }
        }



        return $dataProvider;
        */
    }

    public function getMocks()
    {
        return $this->columnManager->extractCode('getEntityMock', [***REMOVED***);

        /*
        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {
                $clearClass = str_replace('add', '', $newMock);
                $classId    = str_replace('addId', '', $newMock);

                $mock = '        ';
                $mock .= sprintf('$%s = ', $this->createVar($clearClass));
                $mock .= sprintf(
                    '$this->prophesize(\'%s\\Entity\\%s\')->reveal();',
                    $this->getModule()->getModuleName(),
                    $this->str('class', $classId)
                ).PHP_EOL;
                $mocks[***REMOVED*** = $mock;
            }
        }

        return $mocks;
        */
    }


    public function getParams()
    {
        return $this->columnManager->extractCode('getEntityParam', [***REMOVED***, [
            \Gear\Column\Integer\PrimaryKey::class
        ***REMOVED***);

        /*
        $moreMethodsUse = $this->getExtraSetter();

        if (count($moreMethodsUse)>0) {
            foreach ($moreMethodsUse as $newMock) {
                $classId    = str_replace('add', '', $newMock);
                $params[***REMOVED*** = sprintf('        $%s', $this->str('var-length', $classId));
            }
        }
        */

        //return $params;
    }

    /*

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
        return [***REMOVED***;
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
*/
}
