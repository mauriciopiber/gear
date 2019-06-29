<?php
namespace GearTest\MvcTest\FilterTest;

use PHPUnit\Framework\TestCase as TestCase;
use Gear\Table\TableService\TableService;
use Gear\Schema\Schema\SchemaService;
use Gear\Mvc\TraitService;
use Gear\Mvc\InterfaceService;
use Gear\Mvc\Filter\FilterTestService;
use Gear\Mvc\Factory\FactoryService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Column\ColumnService;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\ScopeTrait;
use GearTest\MvcTest\FilterTest\FilterDataTrait;
use GearTest\UtilTestTrait;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Column\ColumnManager;

/**
 * @group db-filter
 */
class FilterServiceTest extends TestCase
{
    use UtilTestTrait;
    use FilterDataTrait;
    use ScopeTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->vfsLocation = 'module/src/MyModule/Filter';
        $this->createVirtualDir($this->vfsLocation);

        //module
        $this->module = $this->prophesize(ModuleStructure::class);

        //string
        $this->string = new \Gear\Util\String\StringService();

        //template
        $this->templates =  (new \Gear\Module())->getLocation().'/../test/template/module/mvc/filter';

        //code
        $this->code = $this->createCode();


        //array
        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        //injector
        $this->injector = new \Gear\Creator\Injector\Injector($this->arrayService);

        $this->table = $this->prophesize(TableService::class);

        $this->fileCreator = $this->createFileCreator();

        $this->filter = new \Gear\Mvc\Filter\FilterService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->code,
            $this->createDirService(),
            //$this->factoryService->reveal(),
            $this->table->reveal(),
            $this->arrayService,
            $this->injector
        );

        // //filter-test
        // $this->filterTest = $this->prophesize(FilterTestService::class);
        // $this->filter->setFilterTestService($this->filterTest->reveal());

        // //trait
        // $this->traitService = $this->prophesize(TraitService::class);
        // $this->filter->setTraitService($this->traitService->reveal());

        // //factory
        // $this->factory = $this->prophesize(FactoryService::class);
        // $this->filter->setFactoryService($this->factory->reveal());

        // //interface
        // $this->interface = $this->prophesize(InterfaceService::class);
        // $this->filter->setInterfaceService($this->interface->reveal());

        $this->schemaService = $this->prophesize(SchemaService::class);
        $this->filter->setSchemaService($this->schemaService->reveal());

        //$this->column = $this->prophesize(ColumnService::class);
        //$this->filter->setColumnService($this->column->reveal());

        //$this->filter->setTableService($this->table->reveal());

    }

    public function src()
    {
        return $this->getScopeForm('Filter');
    }

    /**
     * @group src-mvc
     * @group src-mvc-filter
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        if (!empty($data->getNamespace())) {
            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));
        } else {
            $this->module->map('Filter')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $file = $this->filter->createFilter($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @dataProvider tables
     * @group inter2
     */
    public function testInstrospectTable(
        $columns,
        $template,
        $unique,
        $nullable,
        $hasColumnImage,
        $hasTableImage,
        $tableName,
        $service,
        $namespace
    ) {

        $table = $this->string->str('class', $tableName);

        $location = vfsStream::url('module');

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        if ($namespace === null) {
            $location = vfsStream::url('module/src/MyModule/Filter');
            $this->module->map('Filter')->willReturn($location)->shouldBeCalled();
        } else {
            $location = vfsStream::url('module/src/MyModule');
            $this->module->getSrcModuleFolder()->willReturn($location)->shouldBeCalled();
            $location .= '/'.str_replace('\\', '/', $namespace);
        }


        $this->db = new \Gear\Schema\Db\Db(['table' => $table***REMOVED***);

        $this->db->setColumnManager(new ColumnManager($columns));
        //$this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();
        //$this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage)->shouldBeCalled();

        $this->table->hasUniqueConstraint($table)->willReturn(false)->shouldBeCalled();
        //$this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage)->shouldBeCalled();
        //$this->table->isNullable($this->db->getTable())->willReturn($nullable)->shouldBeCalled();

        $filter = new \Gear\Schema\Src\Src(
            [
                'name' => sprintf('%sFilter', $table),
                'type' => 'Filter',
                'service' => $service,
                'namespace' => $namespace
            ***REMOVED***
        );

        $this->schemaService->getSrcByDb($this->db, 'Filter')->willReturn($filter)->shouldBeCalled();

        $file = $this->filter->createFilter($this->db);

        $expected = $this->templates.'/db/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

        $this->assertStringEndsWith($location.'/'.$filter->getName().'.php', $file);
    }
}
