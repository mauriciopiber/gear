<?php
namespace Gear\Mvc\Repository;

use Gear\Mvc\AbstractMvcTest;
use Gear\Schema\Src\Src;
use Gear\Schema\Db\Db;
use Gear\Schema\Src\SrcTypesInterface;

class RepositoryTestService extends AbstractMvcTest
{
    const KEY_INSERT = 88;

    const KEY_UPDATE = 98;

    public function createRepositoryTest($data)
    {
        return parent::createTest($data, SrcTypesInterface::REPOSITORY);
    }

    public function createSrcTest()
    {
        $options = [
            'callable' => $this->getCodeTest()->getServiceManagerName($this->src),
            'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
            'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
            'className'  => $this->src->getName(),
            'var'        => $this->str('var-length', $this->src->getName()),
            'module'     => $this->getModule()->getModuleName()
        ***REMOVED***;

        $location = $this->getCodeTest()->getLocation($this->src);

        if ($this->src->isFactory()) {
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

    public function createDbTest()
    {
        $this->columnManager = $this->db->getColumnManager();
        $this->tableName    = $this->str('class', $this->db->getTable());

        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'Repository');

        $location = $this->getCodeTest()->getLocation($this->src);


        $options = [
            'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
            'namespace'     => $this->getCodeTest()->getTestNamespace($this->src),
            'className'     => $this->src->getName(),
            'varLenght'     => $this->str('var-length', $this->tableName),
            'class'         => $this->tableName,
            'module'        => $this->getModule()->getModuleName(),
            'hydrator'      => ['update' => ''***REMOVED***,
            'persist'       => ['create' => '', 'update' => ''***REMOVED***,
            'data'          => ['create' => '', 'update' => ''***REMOVED***
        ***REMOVED***;

        $options['persist'***REMOVED***['create'***REMOVED*** = $this->columnManager->generateCode('getRepositoryTestInsertPersist', [***REMOVED***);
        $options['data'***REMOVED***['create'***REMOVED*** = $this->columnManager->generateCode('getRepositoryTestInsertData', [***REMOVED***);

        $options['persist'***REMOVED***['update'***REMOVED*** = $this->columnManager->generateCode('getRepositoryTestUpdatePersist', [***REMOVED***);
        $options['data'***REMOVED***['update'***REMOVED*** = $this->columnManager->generateCode('getRepositoryTestUpdateData', [***REMOVED***);
        $options['hydrator'***REMOVED***['update'***REMOVED*** = $this->columnManager->generateCode('getRepositoryTestUpdateHydrator', [***REMOVED***);

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
            $location
        );
    }
}
