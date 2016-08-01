<?php
namespace GearTest\MvcTest\ServiceTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\HelperPluginManager;
use PhpParser\ParserFactory;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use GearTest\SingleDbTableTrait;

/**
 * @group fix-table
 * @group module
 * @group module-mvc
 * @group module-mvc-service
 * @group module-mvc-service-service-test
 */
class ServiceTestServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;
    use SingleDbTableTrait;

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


        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/service-test';

        $this->codeTest = new \Gear\Creator\CodeTest;

        $this->factoryTestService = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->traitTestService = $this->prophesize('Gear\Mvc\TraitTestService');

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
            [$this->getAllPossibleColumns(), 'all-columns-db', true, true, true, 'table'***REMOVED***,
            [$this->getSingleColumns(), 'single-db', true, false, false, 'single_db_table'***REMOVED***,
            //[$this->getAllPossibleColumnsNotNull(), '-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), '-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), '-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     * @group RefactoringUnitTest1
     */
    public function testInstrospectTable($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName)
    {
        $table = $this->string->str('class', $tableName);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestServiceFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => $table***REMOVED***);

        $this->service = new \Gear\Mvc\Service\ServiceTestService();
        $this->service->setFileCreator($this->fileCreator);
        $this->service->setStringService($this->string);
        $this->service->setModule($this->module->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage);
        $this->column->renderColumnPart('staticTest')->willReturn('');
        $this->column->renderColumnPart('insertArray')->willReturn('');
        //$this->column->renderColumnPart('insertArray', false, true)->willReturn('');
        $this->column->renderColumnPart('insertAssert')->willReturn('');
        $this->column->renderColumnPart('insertAssert', false, true)->willReturn('');
        $this->column->renderColumnPart('insertSelect')->willReturn('');
        $this->column->renderColumnPart('updateArray')->willReturn('');
        $this->column->renderColumnPart('updateAssert', false, true)->willReturn('');

        $this->service->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->getReferencedTableValidColumnName($this->db->getTable())->willReturn(sprintf('id%s', $table));
        $this->table->verifyTableAssociation($this->db->getTable())->willReturn($hasTableImage);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $this->service->setTableService($this->table->reveal());

        $service = new \GearJson\Src\Src(
            [
                'name' => sprintf('%sService', $table),
                'type' => 'Service',
                'dependency' => [sprintf('Repository\%sRepository', $table)***REMOVED***
        ***REMOVED***);

        $schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $schemaService->getSrcByDb($this->db, 'Service')->willReturn($service);
        $this->service->setSchemaService($schemaService->reveal());

        $this->srcDependency = new \Gear\Creator\SrcDependency;
        $this->srcDependency->setStringService($this->string);
        $this->srcDependency->setModule($this->module->reveal());
        $this->service->setSrcDependency($this->srcDependency);
        $this->codeTest->setSrcDependency($this->srcDependency);
        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setFileCreator($this->fileCreator);
        $this->service->setCodeTest($this->codeTest);



        $this->service->setTraitTestService($this->traitTestService->reveal());


        //$this->service->setFactoryService

        $file = $this->service->introspectFromTable($this->db);

        $expected = $this->templates.'/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
