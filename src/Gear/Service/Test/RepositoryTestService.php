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


    public function createAbstract()
    {
        return $this->createFileFromTemplate(
            'template/test/unit/repository/abstract.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'className' => 'AbstractRepository'
            ),
            'AbstractRepository.php',
            $this->getModule()->getRepositoryFolder()
        );
    }

    public function createFromSrc(Src $src)
    {

    }

    public function createFromDb(Db $db)
    {


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
            $this->tableName.'Test.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }

}
