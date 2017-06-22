<?php
namespace GearTest\MvcTest\ServiceTest;

use PHPUnit_Framework_TestCase as TestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\MvcTest\ServiceTest\ServiceDataTrait;
use GearTest\UtilTestTrait;
use GearJson\Src\Src;
use GearTest\ScopeTrait;
use \Gear\Module;
use Gear\Mvc\Service\ServiceService;
use GearBase\Util\String\StringService;
use Gear\Creator\Code;
use Gear\Creator\Injector\Injector;
use Gear\Mvc\Config\ServiceManager;
use Gear\Util\Vector\ArrayService;
use GearJson\Db\Db;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Column\ColumnManager;

/**
 * @group src-mvc
 * @group db-service
 */
class ServiceServiceTest extends TestCase
{
    use UtilTestTrait;
    use ServiceDataTrait;
    use ScopeTrait;

    public function setUp()
    {
        parent::setUp();

        $this->vfsLocation = 'module/src/MyModule/Service';
        $this->createVirtualDir($this->vfsLocation);


        $this->templates =  (new Module())->getLocation().'/../../test/template/module/mvc/service';

        $this->service = new ServiceService();

        //module
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->service->setModule($this->module->reveal());

        //string
        $this->string = new StringService();
        $this->service->setStringService($this->string);

        $this->fileCreator    = $this->createFileCreator();
        $this->service->setFileCreator($this->fileCreator);

        //code
        $this->code = new Code();
        $this->code->setModule($this->module->reveal());
        $this->code->setStringService($this->string);
        $this->code->setDirService(new \GearBase\Util\Dir\DirService());

        $constructorParams = new ConstructorParams($this->string);
        $this->code->setConstructorParams($constructorParams);

        $this->service->setCode($this->code);


        //factory
        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->service->setFactoryService($this->factory->reveal());

        //trait
        $this->trait = $this->prophesize('Gear\Mvc\TraitService');
        $this->service->setTraitService($this->trait->reveal());

        //array
        $this->arrayService = new ArrayService();

        //injector
        $this->injector = new Injector($this->arrayService);

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->service->setTableService($this->table->reveal());

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $this->service->setSchemaService($this->schemaService->reveal());

        $this->serviceTest = $this->prophesize('Gear\Mvc\Service\ServiceTestService');
        $this->service->setServiceTestService($this->serviceTest->reveal());

        $this->serviceManager = new ServiceManager();
        $this->serviceManager->setModule($this->module->reveal());
        $this->serviceManager->setStringService($this->string);
        $this->service->setServiceManager($this->serviceManager);
    }

    /**
     * @group fix-dependency
     */
    public function testCreateServiceWithSpecialDependency()
    {
        $data = new Src(require __DIR__.'/../_gearfiles/service-with-special-dependency.php');

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));

        $this->factory->createFactory($data)->shouldBeCalled();

        $file = $this->service->create($data);

        $expected = $this->templates.'/src/service-with-special-dependency.phtml';

        $this->assertEquals(
            trim(file_get_contents($expected)),
            trim(file_get_contents($file))
        );
    }

    /**
     * @dataProvider tables
     * @group mvc
     * @group mvc-service
     */
    public function testInstrospectTable(
        $columns,
        $template,
        $nullable,
        $hasColumnImage,
        $hasTableImage,
        $tableName,
        $service,
        $namespace,
        $user = 'all'
    ) {
        $table = $this->string->str('class', $tableName);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        if ($namespace === null) {
            $location = vfsStream::url('module/src/MyModule/Service');
            $this->module->map('Service')->willReturn($location)->shouldBeCalled();
        } else {
            $location = vfsStream::url('module/src/MyModule');
            $this->module->getSrcModuleFolder()->willReturn($location)->shouldBeCalled();
            $location .= '/'.str_replace('\\', '/', $namespace);
        }

        $this->db = new Db(['table' => $table, 'user' => $user***REMOVED***);

        $columnManager = new ColumnManager($columns);
        $this->db->setColumnManager($columnManager);

        $this->table->getReferencedTableValidColumnName('MyService')->willReturn(sprintf('id%s', $table));
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $serviceT = new Src([
            'name' => sprintf('%sService', $table),
            'type' => 'Service',
            'namespace' => $namespace,
            'service' => $service,
            'dependency' => [
                sprintf('%s\%sRepository', ($namespace !== null) ? $namespace : 'Repository', $table),
                'memcached' => '\Zend\Cache\Storage\Adapter\Memcached',
               [
                   'class' => '\Zend\Authentication\AuthenticationService',
                   'aliase' => 'zfcuser_auth_service',
                   'ig_t' => true
               ***REMOVED***
        ***REMOVED******REMOVED***);

        $repository = new Src([
            'name' => sprintf('%sRepository', $table),
            'type' => 'Repository',
            'namespace' => $namespace,
            'service' => $service,
        ***REMOVED***);

        $this->schemaService->getSrcByDb($this->db, 'Service')->willReturn($serviceT);
        $this->schemaService->getSrcByDb($this->db, 'Repository')->willReturn($repository);


        $this->factory->createFactory($serviceT)->shouldBeCalled();


        $this->trait->createTrait($serviceT)->shouldBeCalled();
        $this->serviceTest->introspectFromTable($this->db)->shouldBeCalled();

        $file = $this->service->introspectFromTable($this->db);

        $expected = $this->templates.'/db/'.$template.'.phtml';

        $this->assertEquals(
            trim(file_get_contents($expected)),
            trim(file_get_contents($file))
        );

        $this->assertStringEndsWith($location.'/'.$serviceT->getName().'.php', $file);
    }

    public function src()
    {
        $srcType = 'Service';

        return $this->getScope($srcType);
    }


    /**
     * @group src
     * @group src-service
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

        if ($data->isFactory() && $data->getAbstract() == false) {
            $this->factory->createFactory($data)->shouldBeCalled();
        }

        $file = $this->service->create($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }
}
