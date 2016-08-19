<?php
namespace GearTest\MvcTest\FilterTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use GearTest\SingleDbTableTrait;
use GearTest\ScopeTrait;
use GearTest\MvcTest\FilterTest\FilterDataTrait;

/**
 * @group db-filter
 */
class FilterServiceTest extends AbstractTestCase
{
    use FilterDataTrait;
    use ScopeTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('src')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('src/MyModule')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('src/MyModule/Filter')->at(vfsStreamWrapper::getRoot());

        //module
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        //string
        $this->string = new \GearBase\Util\String\StringService();

        //file-render
        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        //template
        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/filter';

        //src-dependency
        $this->srcDependency = new \Gear\Creator\SrcDependency();
        $this->srcDependency->setModule($this->module->reveal());
        $this->srcDependency->setStringService($this->string);

        //code
        $this->code = new \Gear\Creator\Code();
        $this->code->setModule($this->module->reveal());
        $this->code->setStringService($this->string);
        $this->code->setSrcDependency($this->srcDependency);
        $this->code->setDirService(new \GearBase\Util\Dir\DirService());

        //array
        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        //injector
        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);

        $this->filter = new \Gear\Mvc\Filter\FilterService();

        $this->filter->setFileCreator($this->fileCreator);
        $this->filter->setStringService($this->string);
        $this->filter->setModule($this->module->reveal());
        $this->filter->setCode($this->code);

        $this->filter->setSrcDependency($this->srcDependency);

        //filter-test
        $this->filterTest = $this->prophesize('Gear\Mvc\Filter\FilterTestService');
        $this->filter->setFilterTestService($this->filterTest->reveal());

        //trait
        $this->traitService = $this->prophesize('Gear\Mvc\TraitService');
        $this->filter->setTraitService($this->traitService->reveal());

        //factory
        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->filter->setFactoryService($this->factory->reveal());

        //interface
        $this->interface = $this->prophesize('Gear\Mvc\InterfaceService');
        $this->filter->setInterfaceService($this->interface->reveal());

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $this->filter->setSchemaService($this->schemaService->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->filter->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->filter->setTableService($this->table->reveal());

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

        if (!empty($data->getNamespace())) {
            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));
        } else {
            $this->module->map('Filter')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        if ($data->getService() == 'factories' && $data->getAbstract() == false) {
            if (!empty($data->getNamespace())) {

               $location = str_replace('\\', '/', $data->getNamespace());
               $this->factory->createFactory($data, vfsStream::url('module/src/MyModule').'/'.$location)
                 ->shouldBeCalled();

            } else {
                $this->factory->createFactory($data, vfsStream::url('module'))->shouldBeCalled();
            }
        }

        $file = $this->filter->create($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @dataProvider tables
     * @group db-docs
     * @group db-filter1
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

        if ($namespace === null) {
            $location = vfsStream::url('module/src/MyModule/Filter');
            $this->module->map('Filter')->willReturn($location)->shouldBeCalled();
        } else {
            $location = vfsStream::url('module/src/MyModule');
            $this->module->getSrcModuleFolder()->willReturn($location)->shouldBeCalled();
            $location .= '/'.str_replace('\\', '/', $namespace);
        }


        $this->db = new \GearJson\Db\Db(['table' => $table***REMOVED***);

        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();
        //$this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage)->shouldBeCalled();

        $this->table->hasUniqueConstraint($table)->willReturn(false)->shouldBeCalled();
        //$this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage)->shouldBeCalled();
        //$this->table->isNullable($this->db->getTable())->willReturn($nullable)->shouldBeCalled();

        $filter = new \GearJson\Src\Src(
            [
                'name' => sprintf('%sFilter', $table),
                'type' => 'Filter',
                'service' => $service,
                'namespace' => $namespace
            ***REMOVED***
        );

        $this->schemaService->getSrcByDb($this->db, 'Filter')->willReturn($filter)->shouldBeCalled();


        $this->filterTest->introspectFromTable($this->db)->shouldBeCalled();


        if ($service == 'factories') {
            $this->factory->createFactory($filter, $location)->shouldBeCalled();
        }

        $file = $this->filter->introspectFromTable($this->db);

        $expected = $this->templates.'/db/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
