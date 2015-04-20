<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;
use Gear\Metadata\Table;
use Gear\ValueObject\Src;
use Gear\ValueObject\Db;

class RepositoryTestService extends AbstractFixtureService
{
    protected $tableName;
    protected $tableColumns;
    protected $table;


    public function createAbstract($className = null)
    {
        if (empty($className)) {
            $className = 'AbstractRepository';
        }

        return $this->createFileFromTemplate(
            'template/test/unit/repository/abstract.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'className' => $className
            ),
            $className.'Test.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }

    public function createFromSrc(Src $src)
    {
        $this->className = $src->getName();
        $classNameWithType = ($this->endsWith($this->className, 'Repository')) ? $this->className : $this->className.'Repository';

        $this->createFileFromTemplate(
            'template/test/unit/repository/src.repository.phtml',
            array(
                'serviceNameUline' => $this->str('var', $src->getName()),
                'serviceNameClass'   => $classNameWithType,
                'className' => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }

    public function introspectFromTable(Db $table)
    {
        $this->loadTable($table);

        $this->setBaseArray(array(
        	'method' => $this->tableName, 'module' => $this->getConfig()->getModule()
        ));

        $this->usePrimaryKey = true;

        $entityValues = $this->getValuesForUnitTest();

        $this->createFileFromTemplate(
            'template/test/unit/repository/full.repository.phtml',
            array(
                'fixtureSize' => $this->getFixtureSizeByTableName(),
                'serviceNameUline' => $this->str('var', $this->tableName),
                'serviceNameClass'   => $this->tableName,
                'module'  => $this->getConfig()->getModule(),
                'order' => $this->getOrderByForUnitTest(),
                'oneBy' => $this->getSelectOneByForUnitTest(),
                'insertArray' => $entityValues->getInsertArray(),
                'updateArray' => $entityValues->getUpdateArray(),
                'insertAssert' => $entityValues->getInsertAssert(),
                'updateAssert' => $entityValues->getUpdateAssert()
            ),
            $this->tableName.'RepositoryTest.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }

}
