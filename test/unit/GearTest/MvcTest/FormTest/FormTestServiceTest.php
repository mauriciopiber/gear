<?php
namespace GearTest\MvcTest\FormTest;

use GearBaseTest\AbstractTestCase;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use org\bovigo\vfs\vfsStream;

/**
 * @group src-form
 * @group Form
 */
class FormTestServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');


        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/form-test';

    }

    public function tables()
    {
        return [
            [$this->getAllPossibleColumns(), 'all-columns-db', 'table'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     * @group n99
     */
    public function testCreateDb($tableColumns, $expected, $tableName)
    {
        $table = $this->string->str('class', $tableName);

        $db = new \GearJson\Db\Db(['table' => $table***REMOVED***);

        $this->module->getTestFormFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');

        $src = new \GearJson\Src\Src(['name' => $table.'Form', 'type' => 'Form'***REMOVED***);

        $this->form = new \Gear\Mvc\Form\FormTestService();
        $this->form->setStringService($this->string);
        $this->form->setFileCreator($this->fileCreator);
        $this->form->setModule($this->module->reveal());

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->schema->getSrcByDb($db, 'Form')->willReturn($src);

        $this->form->setSchemaService($this->schema->reveal());


        $this->trait = $this->prophesize('Gear\Mvc\TraitTestService');

        $this->form->setTraitTestService($this->trait->reveal());

        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setStringService($this->string);
        $serviceManager->setModule($this->module->reveal());

        $this->form->setServiceManager($serviceManager);

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->getPrimaryKeyColumns($tableName)->willReturn(['idMyController'***REMOVED***);
        $this->form->setTableService($this->table->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');

        $this->column->getColumns($db)->willReturn($tableColumns);

        $this->form->setColumnService($this->column->reveal());


        $file = $this->form->introspectFromTable($db);

        $this->assertEquals(file_get_contents($this->template.'/'.$expected.'.phtml'), file_get_contents($file));
    }
}
