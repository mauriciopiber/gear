<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Common\SchemaToolServiceTrait;
use Gear\Common\TableServiceTrait;

class DbController extends AbstractConsoleController
{

    use SchemaToolServiceTrait;
    use TableServiceTrait;

    public function createColumnAction()
    {
        $tableName = $this->getRequest()->getParam('table');
        $columnName = $this->getRequest()->getParam('name');
        $columnType = $this->getRequest()->getParam('type');
        $columnLimit = $this->getRequest()->getParam('limit', null);
        $columnNull  = (bool) $this->getRequest()->getParam('null', null);

        $tableService = $this->getTableService();

        $tableService->createColumn($tableName, $columnName, $columnType, $columnLimit, $columnNull);

        return new ConsoleModel();

    }

    public function dropTableAction()
    {
        $tableName = $this->getRequest()->getParam('table');

        $tableService = $this->getTableService();

        $tableService->dropTable($tableName);

        return new ConsoleModel();
    }


    public function autoincrementTableAction()
    {
        $schemaToolService = $this->getSchemaToolService();
        $tableName = $this->getRequest()->getParam('table');
        $schemaToolService->autoincrementTable($tableName);
        return new ConsoleModel();
    }

    public function autoincrementDatabaseAction()
    {
        $schemaToolService = $this->getSchemaToolService();
        $schemaToolService->autoincrementDatabase();
        return new ConsoleModel();
    }

    public function clearTableAction()
    {
        $schemaToolService = $this->getSchemaToolService();
        $tableName = $this->getRequest()->getParam('table');
        $schemaToolService->clearTable($tableName);
        return new ConsoleModel();
    }

    public function analyseDatabaseAction()
    {
        $schemaToolService = $this->getSchemaToolService();
        $schemaToolService->doAnalyseDatabase();
        return new ConsoleModel();
    }


    public function analyseTableAction()
    {
        $schemaToolService = $this->getSchemaToolService();
        $tableName = $this->getRequest()->getParam('table');
        $schemaToolService->doAnalyseTable($tableName);
        return new ConsoleModel();
    }


    public function fixTableAction()
    {
        $schemaToolService = $this->getSchemaToolService();
        $tableName = $this->getRequest()->getParam('table');
        $schemaToolService->fixTable($tableName);
        return new ConsoleModel();
    }


    public function fixDatabaseAction()
    {
        $schemaToolService = $this->getSchemaToolService();
        $schemaToolService->fixDatabase();
        return new ConsoleModel();
    }
}
