<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Common\SchemaToolServiceTrait;

class DbController extends AbstractConsoleController
{

    use SchemaToolServiceTrait;

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
