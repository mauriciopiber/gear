<?php
namespace Gear\Mvc\Repository;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Src\Src;
use GearJson\Db\Db;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Mvc\Repository\ColumnInterface\RepositoryInsertTestInterface;
use Gear\Mvc\Repository\ColumnInterface\RepositoryUpdateTestInterface;

class RepositoryTestService extends AbstractMvcTest
{
    use ServiceManagerTrait;

    protected $tableName;
    protected $tableColumns;
    protected $table;

    const KEY_INSERT = 88;

    const KEY_UPDATE = 98;

    public function createAbstract($className = null)
    {
        if (empty($className)) {
            $className = 'AbstractRepository';
        }

        return $this->getFileCreator()->createFile(
            'template/module/test/unit/repository/abstract.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'className' => $className
            ),
            $className.'Test.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }

    public function createFromSrc(Src $src)
    {
        $this->src = $src;

        if ($this->src->getDb() !== null) {
            return $this->introspectFromTable($this->src->getDb());
        }

        $this->className = $this->src->getName();

        $this->dependency = $this->getSrcDependency()->setSrc($this->src);

        $this->functions  = $this->dependency->getTests();

        $location = $this->getCodeTest()->getLocation($this->src);

        $this->getTraitTestService()->createTraitTest($this->src, $location);


        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());

        return $this->getFileCreator()->createFile(
            'template/module/mvc/repository/test-src.phtml',
            array(
                'callable' => $this->getServiceManager()->getServiceName($this->src),
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
                'mock'       => $mock,
                'functions'  => $this->functions,
                'var'        => $this->str('var-lenght', $this->src->getName()),
                'className'  => $src->getName(),
                'module'     => $this->getModule()->getModuleName()
            ),
            $this->src->getName().'Test.php',
            $location
        );
    }

    public function introspectFromTable(Db $table)
    {
        $this->db           = $table;
        $this->tableName    = $this->str('class', $this->db->getTable());

        $this->repository = true;

        $this->setBaseArray(array(
            'method' => $this->tableName, 'module' => $this->getModule()->getModuleName()
        ));

        $this->usePrimaryKey = true;

        $location = $this->getModule()->getTestRepositoryFolder();

        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'Repository');
        if ($this->src->getService() == static::$factories) {
            $this->getFactoryTestService()->createFactoryTest($this->src, $location);
        }

        $options = array(
            'static'       => $this->getColumnService()->renderColumnPart('staticTest'),
            'varLenght'    => $this->str('var-lenght', $this->tableName),
            'class'        => $this->tableName,
            'module'       => $this->getModule()->getModuleName(),
            'hydrator'     => ['update' => ''***REMOVED***,
            'persist'      => ['create' => '', 'update' => ''***REMOVED***,
            'data'         => ['create' => '', 'update' => ''***REMOVED***
        );

        foreach ($this->getColumnService()->getColumns($table) as $column) {

            if ($column instanceof RepositoryInsertTestInterface) {
                $options['persist'***REMOVED***['create'***REMOVED*** .= $column->getRepositoryTestInsertPersist();
                $options['data'***REMOVED***['create'***REMOVED*** .= $column->getRepositoryTestInsertData();
            }

            if ($column instanceof RepositoryUpdateTestInterface) {
                $options['persist'***REMOVED***['update'***REMOVED*** .= $column->getRepositoryTestUpdatePersist();
                $options['data'***REMOVED***['update'***REMOVED*** .= $column->getRepositoryTestUpdateData();
                $options['hydrator'***REMOVED***['update'***REMOVED*** .= $column->getRepositoryTestUpdateHydrator();
            }
        }

        $this->getTraitTestService()->createTraitTest($this->src, $location);

        $options['idTable'***REMOVED*** = $this->str('class', $this->getTableService()->getPrimaryKeyColumnName($this->db->getTable()));
        $options['idTableVar'***REMOVED*** = $this->str('var', $options['idTable'***REMOVED***);

        return $this->getFileCreator()->createFile(
            'template/module/mvc/repository/db-test.phtml',
            $options,
            $this->tableName.'RepositoryTest.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }
}
