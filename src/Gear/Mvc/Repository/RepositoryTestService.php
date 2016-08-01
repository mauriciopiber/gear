<?php
namespace Gear\Mvc\Repository;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Src\Src;
use GearJson\Db\Db;
use Gear\Mvc\Config\ServiceManagerTrait;

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

        $this->getColumnService()->getColumns($table);

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

        $this->getTraitTestService()->createTraitTest($this->src, $location);

        $this->idTable = $this->str('class', $this->getTableService()->getPrimaryKeyColumnName($this->db->getTable()));

        return $this->getFileCreator()->createFile(
            'template/module/mvc/repository/db-test.phtml',
            array(
                'idTable'      => $this->idTable,
                'idTableVar'   => $this->str('var', $this->idTable),
                'static'       => $this->getColumnService()->renderColumnPart('staticTest'),
                'fixtureSize'  => $this->getFixtureSizeByTableName(),
                'varLenght'    => $this->str('var-lenght', $this->tableName),
                'class'        => $this->tableName,
                'module'       => $this->getModule()->getModuleName(),
            ),
            $this->tableName.'RepositoryTest.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }
}
