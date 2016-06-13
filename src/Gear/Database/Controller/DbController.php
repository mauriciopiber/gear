<?php
namespace Gear\Database\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Database\SchemaToolServiceTrait;
use Gear\Database\TableServiceTrait;
use Gear\Database\BackupServiceTrait;
use Gear\Database\AutoincrementServiceTrait;

class DbController extends AbstractConsoleController
{

    use SchemaToolServiceTrait;
    use TableServiceTrait;
    use BackupServiceTrait;
    use AutoincrementServiceTrait;

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

    public function mockTableAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'database-mock-table'));

        $tableService = $this->getTableService();

        $tableService->mockTable();

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function dropTableAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'database-drop-table'));
        $tableName = $this->getRequest()->getParam('table');

        $tableService = $this->getTableService();

        $tableService->dropTable($tableName);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }


    public function autoincrementTableAction()
    {
        $schemaToolService = $this->getAutoincrementService();
        $tableName = $this->getRequest()->getParam('table');
        $schemaToolService->autoincrementTable($tableName);
        return new ConsoleModel();
    }

    public function autoincrementDatabaseAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'database-truncate'));

        $schemaToolService = $this->getAutoincrementService();
        $schemaToolService->autoincrementDatabase();

        $this->getEventManager()->trigger('gear.pos', $this);
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
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'database-fix-table'));
        $schemaToolService = $this->getSchemaToolService();
        $tableName = $this->getRequest()->getParam('table');
        $schemaToolService->fixTable($tableName);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }


    public function fixDatabaseAction()
    {
        $schemaToolService = $this->getSchemaToolService();
        $schemaToolService->fixDatabase();
        return new ConsoleModel();
    }

    public function getOrderAction()
    {
        $schemaToolService = $this->getSchemaToolService();
        $schemaToolService->getOrder();
        return new ConsoleModel();
    }

    public function mysqlDumpAction()
    {
        $this->getBackupService()->mysqlDump();

        return new ConsoleModel();
    }


    public function moduleDumpAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'database-module-dump'));

        $this->getBackupService()->moduleDump();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function moduleLoadAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'database-module-load'));

        $this->getBackupService()->moduleLoad();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }



    public function mysqlLoadAction()
    {
        $this->getBackupService()->mysqlLoad();
    }
}
