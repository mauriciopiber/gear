<?php
namespace GearTest\MvcTest\ServiceTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use GearTest\SingleDbTableTrait;

/**
 * @group src-mvc
 * @group db-service
 */
class ServiceServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;
    use SingleDbTableTrait;
    use \GearTest\ScopeTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');

        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/service';

        $this->service = new \Gear\Mvc\Service\ServiceService();

        //module
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->service->setModule($this->module->reveal());

        //string
        $this->string = new \GearBase\Util\String\StringService();
        $this->service->setStringService($this->string);

        //file-render
        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);
        $this->service->setFileCreator($this->fileCreator);

        //src-dependency
        $this->srcDependency = new \Gear\Creator\SrcDependency();
        $this->srcDependency->setModule($this->module->reveal());
        $this->srcDependency->setStringService($this->string);


        $this->service->setSrcDependency($this->srcDependency);
        //code
        $this->code = new \Gear\Creator\Code();
        $this->code->setModule($this->module->reveal());
        $this->code->setStringService($this->string);
        $this->code->setSrcDependency($this->srcDependency);
        $this->code->setDirService(new \GearBase\Util\Dir\DirService());
        $this->service->setCode($this->code);

        //factory
        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->service->setFactoryService($this->factory->reveal());

        //trait
        $this->traitService = $this->prophesize('Gear\Mvc\TraitService');
        $this->service->setTraitService($this->traitService->reveal());

        //array
        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        //injector
        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->service->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->service->setTableService($this->table->reveal());

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $this->service->setSchemaService($this->schemaService->reveal());

        $this->serviceTest = $this->prophesize('Gear\Mvc\Service\ServiceTestService');
        $this->service->setServiceTestService($this->serviceTest->reveal());

    }

    public function tables()
    {
        return [
            [$this->getAllPossibleColumns(), 'all-columns-db', true, true, true, 'table', 'invokables', null***REMOVED***,
            [$this->getSingleColumns(), 'single-db', true, false, false, 'single_db_table', 'invokables', null***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-factory', true, true, true, 'table', 'factories', null***REMOVED***,
            [$this->getSingleColumns(), 'single-db-factory', true, false, false, 'single_db_table', 'factories', null***REMOVED***,
            [$this->getSingleColumns(), 'single-db-namespace', true, false, false, 'single_db_table', 'invokables', 'Custom\CustomNamespace'***REMOVED***,
            //[$this->getAllPossibleColumnsNotNull(), '-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), '-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), '-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     * @group RefactoringUnitTest
     * @group db-docs1
     * @group db-service
     * @group db-factory-namespace
     */
    public function testInstrospectTable($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName)
    {
        $table = $this->string->str('class', $tableName);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getServiceFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => $table***REMOVED***);

        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();
        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage);

        $this->table->getReferencedTableValidColumnName('MyService')->willReturn(sprintf('id%s', $table));
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $service = new \GearJson\Src\Src(['name' => sprintf('%sService', $table), 'type' => 'Service'***REMOVED***);

        $this->schemaService->getSrcByDb($this->db, 'Service')->willReturn($service);

        $file = $this->service->introspectFromTable($this->db);

        $expected = $this->templates.'/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function src()
    {
        $srcType = 'Service';

        return $this->getScope($srcType);
    }


    /**
     * @group src-mvc
     * @group src-mvc-service
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        if (!empty($data->getNamespace())) {

            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));

        } else {
            $this->module->map('Service')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        if ($data->getService() == 'factories' && $data->getAbstract() == false) {


            if (!empty($data->getNamespace())) {
               $this->factory->createFactory(
                   $data,
                   vfsStream::url('module/src/MyModule').'/'.str_replace('\\', '/', $data->getNamespace())
               )->shouldBeCalled();
            } else {
                $this->factory->createFactory($data, vfsStream::url('module'))->shouldBeCalled();
            }
        }

        $file = $this->service->create($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }
}
