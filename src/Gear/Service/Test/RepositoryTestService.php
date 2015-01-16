<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;
use Gear\Metadata\Table;

class RepositoryTestService extends AbstractFixtureService
{
    protected $tableName;
    protected $tableColumns;
    protected $table;

    public function introspectFromTable($table)
    {
        $this->loadTable($table);

        $this->setBaseArray(array(
        	'method' => $this->tableName, 'module' => $this->getConfig()->getModule()
        ));

        $this->usePrimaryKey = true;

        $entityValues = $this->getValuesForUnitTest();

        $this->createFileFromTemplate(
            'template/test/unit/repository/src.repository.phtml',
            array(
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
