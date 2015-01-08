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

use Gear\Service\AbstractJsonService;

class EntityService extends AbstractJsonService
{

    use \Gear\Service\Module\ScriptServiceTrait;
    protected $entityTestService;

    protected $doctrineService;

    protected $tableName;

    protected $tableColumns;

    protected $mockColumns;

    public function getMetadata()
    {
        return $this->getServiceLocator()->get('Gear\Factory\Metadata');;
    }

    public function create($src)
    {
        $class = $src->getName();

        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        $this->tableName = $src->getDb();
        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));
        $this->table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $this->tableName)));

        $this->setUpEntity(array('tables' => $this->tableName));

        $assertNull = $this->getTestGettersNull();
        $assertSet  = $this->getTestSetters();

        $this->createFileFromTemplate(
            'template/test/unit/entity/src.entity.phtml',
            array(
                'serviceNameUline' => $this->str('var', $class),
                'serviceNameClass'   => $class,
                'module'  => $this->getConfig()->getModule(),
                'assertNull' => $assertNull,
                'assertSet'  => $assertSet,
                'params' => $this->getParams(),
                'provider' => $this->getProvider(),
                'mocks' => $this->getMocks()
            ),
            $class.'Test.php',
            $this->getModule()->getTestEntityFolder()
        );
    }

    public function getExtraGetter($useMethods)
    {
        $classMethods = get_class_methods('\Teste\Entity\\'.$this->str('class', $this->tableName));

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
        $classMethods = get_class_methods('\Teste\Entity\\'.$this->str('class', $this->tableName));

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
                $mock .= sprintf('$this->getMockBuilder(\'%s\\Entity\\%s\')->getMock();', $this->getConfig()->getModule(), $this->str('class', $referencedTable)).PHP_EOL;
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





    public function getDoctrineService()
    {
        if (!isset($this->doctrineService)) {
            $this->doctrineService = $this->getServiceLocator()->get('doctrineService');
        }
        return $this->doctrineService;
    }

    public function getEntityTestService()
    {
        return $this->entityTestService;
    }

    public function setEntityTestService($entityTestService)
    {
        $this->entityTestService = $entityTestService;
        return $this;
    }
    /**
     * @todo Verifica se existe src no json. Se já existe, exibe mensagem e retorna.
     * Se não existe, salva src.
     * Gera a nova entidade.
     * Verifica se é necessário remover as entidades atuais.
     */
    public function createFromTable($table)
    {
        $this->getDoctrineService()->createFromTable($table);
    }

    /**
     * @todo Verifica toda metatada e tenta inserir no src do json. Se já existe, exibe mensagem e retorna.
     * Se não existe, salva src.
     * Gera a nova entidade.
     * Verifica se é necessário remover as entidades atuais.
     */
    public function createFromMetadata()
    {
        $this->getDoctrineService()->createFromMetadata();
    }

    public function getTables()
    {
        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        return $metadata->getTables();
    }

    public function getNames()
    {
        $dbs = $this->getGearSchema()->__extractObject('db');

        $names = [***REMOVED***;

        if (count($dbs) > 0) {
            foreach ($dbs as $table) {
                $names[***REMOVED*** = $table->getTable();
            }
        }

        $srcs = $this->getGearSchema()->__extractObject('src');

        foreach ($srcs as $src) {

            if ($src->getType() == 'Entity') {
                $names[***REMOVED*** = $src->getName();
            }

        }



        return $names;
    }

    public function excludeMapping()
    {
        $ymlFiles = $this->getModule()->getSrcFolder();


        foreach (glob($ymlFiles.'/*') as $i => $v) {

            $entity = explode('/',$v);
            if (end($entity)!==$this->getConfig()->getModule()) {
                 $this->getDirService()->rmDir($v);
            }

        }
    }

    public function excludeEntities($names = array())
    {
        $names = array_merge($this->getNames(), $names);

        $entitys = $this->getModule()->getEntityFolder();

        foreach (glob($entitys.'/*.php') as $i => $entityFullPath) {

            $entity = explode('/',$entityFullPath);
            $name = explode('.',end($entity));

            if (!in_array($name[0***REMOVED***, $names)) {
                unlink($entityFullPath);
                unlink($entityFullPath.'~');
            } else {
                if (is_file($entityFullPath.'~')) {
                    unlink($entityFullPath.'~');
                }
            }

        }


    }

    public function introspectFromTable(\Zend\Db\Metadata\Object\TableObject $dbTable)
    {
        $doctrineService = $this->getDoctrineService();

        $scriptService = $this->getScriptService();
        $scriptService->run($doctrineService->getOrmConvertMapping());
        $scriptService->run($doctrineService->getOrmGenerateEntities());

        $this->excludeMapping();
        $this->excludeEntities();

        return true;
    }

    public function setUpEntities($data)
    {
        $doctrineService = $this->getDoctrineService();

        $scriptService = $this->getScriptService();

        echo $scriptService->run($doctrineService->getOrmValidateSchema());
        echo $scriptService->run($doctrineService->getOrmConvertMapping());
        echo $scriptService->run($doctrineService->getOrmGenerateEntities());
        echo $scriptService->run($doctrineService->getOrmValidateSchema());

        //criar o mapping
        //criar as entidades
        //criar de todo banco
        //limpar lixo
        return true;
    }

    public function setUpEntity($data)
    {
        if (is_string($data['tables'***REMOVED***)) {
            $tables = explode(',', $data['tables'***REMOVED***);
        } elseif (is_array($data['tables'***REMOVED***)) {
            $tables = $data['tables'***REMOVED***;
        }

        $doctrineService = $this->getDoctrineService();

        $scriptService = $this->getScriptService();
        $scriptService->run($doctrineService->getOrmConvertMapping());
        $scriptService->run($doctrineService->getOrmGenerateEntities());

        $this->excludeMapping();
        $this->excludeEntities($tables);
        return true;
    }

}
