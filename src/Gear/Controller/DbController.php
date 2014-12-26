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

    public function analyseAction()
    {

        $schemaToolService = $this->getSchemaToolService();

        $schemaToolService->doAnalyse();

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
