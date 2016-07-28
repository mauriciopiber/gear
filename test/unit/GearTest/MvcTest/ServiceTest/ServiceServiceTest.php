<?php
namespace GearTest\MvcTest\ServiceTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;

/**
 * @group fix-table
 * @group module
 * @group module-mvc
 * @group module-mvc-service
 * @group module-mvc-service-service-test
 */
class ServiceServiceTest extends AbstractTestCase
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


        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/service';

        $this->code = $this->prophesize('Gear\Creator\Code');

        $this->factoryService = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->traitService = $this->prophesize('Gear\Mvc\TraitService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();
        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);
    }

    public function tables()
    {
        /**
        $db = new Db(['table' => 'MyService'***REMOVED***);

        $action = new Action([
            'name' => 'MyAction',
            'service' => new Service(['name' => 'MyService', 'object' => '%s\Service\MyService'***REMOVED***),
            'db' => $db
        ***REMOVED***);


        return [
            [$action, $this->getAllPossibleColumns(), '', true, false***REMOVED***,
            [$action, $this->getAllPossibleColumnsNotNull(), '.not.null', false, false***REMOVED***,
            [$action, $this->getAllPossibleColumnsUnique(), '.unique', true, true***REMOVED***,
            [$action, $this->getAllPossibleColumnsUniqueNotNull(), '.unique.not.null', false, true***REMOVED***,
        ***REMOVED***;
        */
        return [
            [$this->getAllPossibleColumns(), '', true***REMOVED***,
            //[$this->getAllPossibleColumnsNotNull(), '-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), '-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), '-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     * @group RefactoringUnitTest
     */
    public function testInstrospectTable($columns, $template, $nullable)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getServiceFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => 'MyService'***REMOVED***);

        $this->service = new \Gear\Mvc\Service\ServiceService();
        $this->service->setFileCreator($this->fileCreator);
        $this->service->setStringService($this->string);
        $this->service->setModule($this->module->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn(true);

        $this->service->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->getReferencedTableValidColumnName('MyService')->willReturn('idMyController');
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(false);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $this->service->setTableService($this->table->reveal());

        $service = new \GearJson\Src\Src(['name' => 'MyService', 'type' => 'Service'***REMOVED***);

        $schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $schemaService->getSrcByDb($this->db, 'Service')->willReturn($service);

        $this->service->setCode($this->code->reveal());

        $this->service->setSchemaService($schemaService->reveal());

        $this->service->setTraitService($this->traitService->reveal());

        $srcDependency = $this->prophesize('Gear\Creator\SrcDependency');
        $this->service->setSrcDependency($srcDependency->reveal());
        //$this->service->setFactoryService

        $this->serviceTest = $this->prophesize('Gear\Mvc\Service\ServiceTestService');

        $this->service->setServiceTestService($this->serviceTest->reveal());

        $file = $this->service->introspectFromTable($this->db);

        $expected = $this->templates.'/all-columns-db'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
