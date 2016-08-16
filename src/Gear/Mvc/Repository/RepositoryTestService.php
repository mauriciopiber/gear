<?php
namespace Gear\Mvc\Repository;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Src\Src;
use GearJson\Db\Db;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Mvc\Repository\ColumnInterface\RepositoryInsertTestInterface;
use Gear\Mvc\Repository\ColumnInterface\RepositoryUpdateTestInterface;
use Gear\Mvc\Repository\ColumnInterface\ShitInterface;

class RepositoryTestService extends AbstractMvcTest implements ShitInterface
{
    use ServiceManagerTrait;

    protected $tableName;
    protected $tableColumns;
    protected $table;

    const KEY_INSERT = 88;

    const KEY_UPDATE = 98;

    public function createFromSrc(Src $src)
    {
        $this->src = $src;

        if ($this->src->getDb() !== null) {
            return $this->introspectFromTable($this->src->getDb());
        }

        $this->className = $this->src->getName();

        $this->dependency = $this->getSrcDependency()->setSrc($this->src);

        $options = [
            'callable' => $this->getServiceManager()->getServiceName($this->src),
            'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
            'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
            'className'  => $src->getName(),
            'var'        => $this->str('var-lenght', $this->src->getName()),
            'module'     => $this->getModule()->getModuleName()
        ***REMOVED***;

        $location = $this->getCodeTest()->getLocation($this->src);

        if ($this->src->getAbstract() !== true) {
            $this->getTraitTestService()->createTraitTest($this->src, $location);
        }

        if ($this->src->getService() === 'factories' && $this->src->getAbstract() == false) {

            $this->getFactoryTestService()->createFactoryTest($this->src, $location);
        }

        if ($this->src->getService() === 'factories') {

            $templateView = ($this->src->getAbstract() === true) ? 'abstract-factory' : 'factory';

            $options['dependency'***REMOVED*** = $this->getCodeTest()->getConstructorDependency($this->src);

            if ($this->src->getAbstract() === true) {
                $options['dependencyReveal'***REMOVED*** = $this->getCodeTest()->getDependencyReveal($this->src);
            } else {
                $options['constructor'***REMOVED*** = $this->getCodeTest()->getConstructor($this->src);
            }

        } else {
            //add abstract-factory
            $templateView = ($this->src->getAbstract() === true) ? 'abstract-invokable' : 'invokable';
        }

        return $this->getFileCreator()->createFile(
            'template/module/mvc/repository-test/src/'.$templateView.'.phtml',
            $options,
            $this->src->getName().'Test.php',
            $location
        );
    }

    public function introspectFromTable(Db $table)
    {
        $this->db           = $table;
        $this->tableName    = $this->str('class', $this->db->getTable());

        $this->repository = true;
        $this->usePrimaryKey = true;

        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'Repository');

        $location = $this->getCodeTest()->getLocation($this->src);

        if ($this->src->getService() == static::$factories) {
            $this->getFactoryTestService()->createFactoryTest($this->src, $location);
        }

        $options = [
            'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
            'namespace'     => $this->getCodeTest()->getTestNamespace($this->src),
            'className'     => $this->src->getName(),
            'static'        => $this->getColumnService()->renderColumnPart('staticTest'),
            'varLenght'     => $this->str('var-lenght', $this->tableName),
            'class'         => $this->tableName,
            'module'        => $this->getModule()->getModuleName(),
            'hydrator'      => ['update' => ''***REMOVED***,
            'persist'       => ['create' => '', 'update' => ''***REMOVED***,
            'data'          => ['create' => '', 'update' => ''***REMOVED***
        ***REMOVED***;

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

        $options['idTable'***REMOVED*** = $this->str(
            'class',
            $this->getTableService()->getPrimaryKeyColumnName($this->db->getTable())
        );

        $options['idTableVar'***REMOVED*** = $this->str('var', $options['idTable'***REMOVED***);

        $options['constructor'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/mvc/repository-test/db/constructor/'.$this->src->getService().'.phtml',
            [
                'className' => $this->src->getName()
            ***REMOVED***
        );

        return $this->getFileCreator()->createFile(
            'template/module/mvc/repository-test/db/db-test.phtml',
            $options,
            $this->tableName.'RepositoryTest.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }
}
