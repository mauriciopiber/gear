<?php
namespace Gear\Database\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Database\SchemaToolServiceTrait;
use Gear\Database\BackupServiceTrait;
use Gear\Database\AutoincrementServiceTrait;
use Gear\Database\Phinx\PhinxServiceTrait;

class DbController extends AbstractConsoleController
{

    use SchemaToolServiceTrait;
    use BackupServiceTrait;
    use AutoincrementServiceTrait;
    use PhinxServiceTrait;

    public function createMigrationAction()
    {
        $module = $this->getRequest()->getParam('module', null);
        $name = $this->getRequest()->getParam('name');

        $result = $this->getPhinxService()->createMigration($module, $name);

        $model = new ConsoleModel();

        if ($result === false) {
            $model->setErrorLevel(1);
        }

        return $model;
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

    public function projectDumpAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'database-project-dump'));

        $this->getBackupService()->projectDump();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function projectLoadAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'database-project-load'));

        $this->getBackupService()->projectLoad();

        $this->getEventManager()->trigger('gear.pos', $this);

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

    public function dumpAction()
    {
        $this->getBackupService()->dump();

        return new ConsoleModel();
    }

    public function loadAction()
    {
        $this->getBackupService()->load();
    }
}
