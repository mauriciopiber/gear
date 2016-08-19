<?php
namespace GearTest\MvcTest\ServiceTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\HelperPluginManager;
use PhpParser\ParserFactory;
use GearTest\SingleDbTableTrait;
use GearTest\MvcTest\ServiceTest\ServiceDataTrait;
use GearTest\UtilTestTrait;

/**
 * @group fix-table
 * @group module
 * @group module-mvc
 * @group module-mvc-service
 * @group module-mvc-service-service-test
 * @group db-service
 */
class ServiceTestServiceTest extends AbstractTestCase
{
    use UtilTestTrait;
    use ServiceDataTrait;
    use \GearTest\ScopeTrait;

    public function setUp()
    {
        parent::setUp();

        $this->vfsLocation = 'module/test/unit/MyModuleTest/ServiceTest';
        $this->createVirtualDir($this->vfsLocation);
        $this->assertFileExists(vfsStream::url($this->vfsLocation));

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->string = new \GearBase\Util\String\StringService();
        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);


        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/service-test';

        $this->codeTest = new \Gear\Creator\CodeTest;

        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setFileCreator($this->fileCreator);

        $this->srcDependency = new \Gear\Creator\SrcDependency;
        $this->srcDependency->setStringService($this->string);
        $this->srcDependency->setModule($this->module->reveal());

        $this->codeTest->setSrcDependency($this->srcDependency);
        $this->codeTest->setDirService(new \GearBase\Util\Dir\DirService());
        $this->codeTest->setStringService($this->string);


        $this->service = new \Gear\Mvc\Service\ServiceTestService();
        $this->service->setFileCreator($this->fileCreator);
        $this->service->setStringService($this->string);
        $this->service->setModule($this->module->reveal());
        $this->service->setCodeTest($this->codeTest);
        $this->service->setSrcDependency($this->srcDependency);

        $this->factoryTestService = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->traitTestService = $this->prophesize('Gear\Mvc\TraitTestService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();
        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);


        $this->serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $this->serviceManager->setModule($this->module->reveal());
        $this->service->setServiceManager($this->serviceManager);

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->service->setSchemaService($this->schema->reveal());
    }

    /**
     * @dataProvider tables
     * @group RefactoringUnitTest
     * @group db-factory-namespace
     * @group db-service1
     */
    public function testInstrospectTable(
        $columns,
        $template,
        $nullable,
        $hasColumnImage,
        $hasTableImage,
        $tableName,
        $service,
        $namespace
    ) {
        $table = $this->string->str('class', $tableName);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestServiceFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => $table***REMOVED***);

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage);
        $this->column->renderColumnPart('staticTest')->willReturn('');

        $this->service->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->getReferencedTableValidColumnName($this->db->getTable())->willReturn(sprintf('id%s', $table));
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $this->service->setTableService($this->table->reveal());

        $serviceT = new \GearJson\Src\Src(
            [
                'db' => $table,
                'name' => sprintf('%sService', $table),
                'type' => 'Service',
                'namespace' => $namespace,
                'service' => $service,
                'dependency' => [
                    sprintf('%s\%sRepository', ($namespace == null) ? 'Repository' : $namespace, $table),
                    'memcached' => '\Zend\Cache\Storage\Adapter\Memcached'
                ***REMOVED***
            ***REMOVED***
        );

        $schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $schemaService->getSrcByDb($this->db, 'Service')->willReturn($serviceT);

        $this->repository = $this->prophesize('GearJson\Src\Src');
        $this->repository->getName()->willReturn(sprintf('%sRepository', $table));
        $this->repository->getType()->willReturn('Repository');
        $this->repository->getNamespace()->willReturn($namespace);
        $schemaService->getSrcByDb($this->db, 'Repository')->willReturn($this->repository->reveal())->shouldBeCalled();

        $this->entity = $this->prophesize('GearJson\Src\Src');
        $this->entity->getName()->willReturn(sprintf('%s', $table));
        $this->entity->getType()->willReturn('Entity');
        $this->entity->getNamespace()->willReturn(null);
        $schemaService->getSrcByDb($this->db, 'Entity')->willReturn($this->entity->reveal())->shouldBeCalled();


        $this->service->setSchemaService($schemaService->reveal());


        $this->service->setTraitTestService($this->traitTestService->reveal());



        //$this->service->setFactoryService

        $file = $this->service->introspectFromTable($this->db);

        $expected = $this->templates.'/db/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function src()
    {
        return $this->getScope('Service');
    }

    /**
     * @group src-mvc
     * @group src-mvc-service-test
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestServiceFolder()->willReturn(vfsStream::url('module'));

        if (!empty($data->getNamespace())) {
            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest'));
        } else {
            $this->module->map('ServiceTest')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        if ($data->getService() == 'factories') {
            $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
            $this->service->setFactoryTestService($this->factory->reveal());
        }

        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setModule($this->module->reveal());
        $serviceManager->setStringService($this->string);

        $this->service->setServiceManager($serviceManager);

        $this->service->setTraitTestService($this->traitTestService->reveal());

        $srcDependency = new \Gear\Creator\SrcDependency();
        $srcDependency->setModule($this->module->reveal());
        $this->service->setSrcDependency($srcDependency);

        $file = $this->service->create($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

}
