<?php
namespace GearTest\MvcTest\ServiceTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\MvcTest\ServiceTest\ServiceDataTrait;
use GearTest\UtilTestTrait;
use Gear\Schema\Src\Src;
use GearTest\ScopeTrait;
use \Gear\Module;
use Gear\Mvc\Service\ServiceService;
use Gear\Util\String\StringService;
use Gear\Creator\Code;
use Gear\Creator\Injector\Injector;
use Gear\Mvc\Config\ServiceManager;
use Gear\Util\Vector\ArrayService;
use Gear\Schema\Db\Db;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Column\ColumnManager;
use Gear\Util\Dir\DirService;

/**
 * @group src-mvc
 * @group db-service
 */
class ServiceServiceTest extends TestCase
{
    use UtilTestTrait;
    use ServiceDataTrait;
    use ScopeTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->vfsLocation = 'module/src/MyModule/Service';
        $this->createVirtualDir($this->vfsLocation);


        $this->templates =  (new Module())->getLocation().'/../test/template/module/mvc/service';

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->string = new StringService();
        $this->fileCreator    = $this->createFileCreator();

        $this->code = $this->createCode();


        $this->arrayService = new ArrayService();
        $this->table = $this->prophesize('Gear\Table\TableService\TableService');

        $this->service = new ServiceService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->code,
            new DirService(),
            $this->table->reveal(),
            $this->arrayService
        );

        $this->injector = new Injector($this->arrayService);

    }

    /**
     * @group fix-dependency
     */
    public function testCreateServiceWithSpecialDependency()
    {
        $data = new Src(require __DIR__.'/../_gearfiles/service-with-special-dependency.php');

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));

        //$this->factory->createFactory($data)->shouldBeCalled();

        $file = $this->service->createService($data);

        $expected = $this->templates.'/src/service-with-special-dependency.phtml';

        $this->assertEquals(
            trim(file_get_contents($expected)),
            trim(file_get_contents($file))
        );
    }

    /*
     * @dataProvider tables
     * @group inter

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
        $this->serviceTest->createServiceTest($this->db)->shouldBeCalled();

        $file = $this->service->createService($this->db);

        $expected = $this->templates.'/db/'.$template.'.phtml';

        $this->assertEquals(
            trim(file_get_contents($expected)),
            trim(file_get_contents($file))
        );

        $this->assertStringEndsWith($location.'/'.$serviceT->getName().'.php', $file);
    }

    */
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
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        if (!empty($data->getNamespace())) {

            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));

        } else {
            $this->module->map('Service')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }


        //$this->serviceTest->createServiceTest($data)->shouldBeCalled();

        $file = $this->service->createService($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }
}
