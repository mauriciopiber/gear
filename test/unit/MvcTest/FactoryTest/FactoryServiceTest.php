<?php
namespace GearTest\MvcTest\Factory;

use PHPUnit\Framework\TestCase;
use Gear\Util\String\StringService;
use Gear\Util\Dir\DirService;
use Gear\Mvc\Factory\FactoryService;
use Gear\Module;
use Gear\Code\FactoryCode\FactoryCode;
use Gear\Module\Structure\ModuleStructure;
use org\bovigo\vfs\vfsStream;
use GearTest\MvcTest\FactoryTest\FactoryDataTrait;
use Gear\Schema\Src\Src;
use Gear\Schema\Controller\Controller;
use Gear\Creator\Component\Constructor\ConstructorParams;
use GearTest\UtilTestTrait;
use Gear\Schema\Schema\SchemaService;

/**
 * @group db-factory
 */
class FactoryServiceTest extends TestCase
{
    use UtilTestTrait;

    use FactoryDataTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->module->getModuleName()->willReturn('MyModule');


        $this->baseDir = (new Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../view');

        $this->template = $this->baseDir.'/../test/template/module/mvc/factory';

        $fileCreator    = $this->createFileCreator();
        $this->string  = new StringService();
        $this->codeFactory = new FactoryCode(
            $this->module->reveal(),
            $this->string,
            new DirService()
        );

        $this->code = $this->createCode();
        //$constructorParams = new ConstructorParams($this->string);
        //$code->setConstructorParams($constructorParams);

        $this->factory = new FactoryService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->code,
            $this->createDirService(),
            $this->createTableService(),
            $this->createArrayService(),
            $this->createInjector(),
            $this->codeFactory
        );

        $this->schema = $this->prophesize(SchemaService::class);
    }

    /**
     * @group fix-dependency3
     * @group pppp1
     */
    public function testCreateConsoleWithSpecialDependency()
    {
        $location = vfsStream::url('module');

        $this->module->getNamespace()->willReturn('MyModule');
        $this->module->getSrcModuleFolder()->willReturn($location);

        $data = new Controller(require __DIR__.'/../_gearfiles/console-with-special-dependency.php');

        $file = $this->factory->createFactory($data, $location);

        $this->assertEquals(file_get_contents($this->template.'/controller/console-with-special-dependency.phtml'), file_get_contents($file));
    }

    /**
     * @group fix-dependency
     */
    public function testCreateServiceWithSpecialDependency()
    {
        $location = vfsStream::url('module');

        $this->module->getNamespace()->willReturn('MyModule');
        $this->module->getSrcModuleFolder()->willReturn($location);

        $data = new Src(require __DIR__.'/../_gearfiles/service-with-special-dependency.php');

        $file = $this->factory->createFactory($data, $location);

        $this->assertEquals(file_get_contents($this->template.'/src/service-with-special-dependency.phtml'), file_get_contents($file));
    }

    /**
     * @group fix-dependency2
     */
    public function testCreateRepositoryWithSpecialDependency()
    {
        $location = vfsStream::url('module');

        $this->module->getNamespace()->willReturn('MyModule');
        $this->module->getSrcModuleFolder()->willReturn($location);

        $data = new Src(require __DIR__.'/../_gearfiles/repository-with-special-dependency.php');

        $file = $this->factory->createFactory($data, $location);

        $this->assertEquals(file_get_contents($this->template.'/src/repository-with-special-dependency.phtml'), file_get_contents($file));
    }


    public function getData()
    {
        return $this->getFactoryData();
    }


    /**
     * @dataProvider getData
     * @group db-factory-namespace
     * @group mvc
     * @group mvc-factory
     */
    public function testCreateDb($data, $template)
    {
        $this->module->map($data->getType())->willReturn(vfsStream::url('module'));
        $this->module->map('Controller')->willReturn(vfsStream::url('module'));
        $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module'));
        $this->module->getNamespace()->willReturn('MyModule');

        /*
        if ($data instanceof Src && $data->getTemplate() == 'search-form') {

            $this->filter = $this->prophesize(Src::class);
            $this->filter->getName()->willReturn('MyTableFilter');
            $this->filter->getType()->willReturn('Filter');

            $this->schema->getSrcByDb($data->getDb(), 'Filter')->willReturn($this->filter->reveal());

            $this->form = $this->prophesize(Src::class);
            $this->form->getName()->willReturn('MyTableForm');
            $this->form->getType()->willReturn('Form');
            $this->schema->getSrcByDb($data->getDb(), 'Form')->willReturn($this->form);

            $this->entity = $this->prophesize(Src::class);
            $this->entity->getName()->willReturn('MyTableEntity');
            $this->entity->getType()->willReturn('Entity');
            $this->schema->getSrcByDb($data->getDb(), 'Entity')->willReturn($this->entity);
        }*/

        if ($data instanceof Src && $data->getTemplate() == 'form-filter') {

            $this->filter = $this->prophesize(Src::class);
            $this->filter->getName()->willReturn('MyTableFilter');
            $this->filter->getType()->willReturn('Filter');
            $this->filter->getNamespace()->willReturn($data->getNamespace());


            $this->schema->getSrcByDb($data->getDb(), 'Filter')->willReturn($this->filter->reveal());

            $this->form = $this->prophesize(Src::class);
            $this->form->getName()->willReturn('MyTableForm');
            $this->form->getType()->willReturn('Form');
            $this->form->getNamespace()->willReturn($data->getNamespace());


            $this->schema->getSrcByDb($data->getDb(), 'Form')->willReturn($this->form);

            $this->entity = $this->prophesize(Src::class);
            $this->entity->getName()->willReturn('MyTable');
            $this->entity->getType()->willReturn('Entity');
            $this->entity->getNamespace()->willReturn(null);
            $this->schema->getSrcByDb($data->getDb(), 'Entity')->willReturn($this->entity);
        }


        $file = $this->factory->createFactory($data, vfsStream::url('module'));

        $this->assertEquals(
            file_get_contents($this->template.'/db/'.$template.'.phtml'),
            file_get_contents($file)
        );
    }

    public function testCreateFactoryDependency()
    {
        $location = vfsStream::url('module');

        $this->module->map('Service')->willReturn($location);
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();


        $expected = 'dependencies';

        $src = new Src([
            'name' => 'MyService',
            'type' => 'Service',
            'service' => 'factories',
            'dependency' => [
                'Repository\DependencyOne',
                'Service\DependencyTwo'
            ***REMOVED***
        ***REMOVED***);

        $file = $this->factory->createFactory($src, $location);

        $this->assertEquals(file_get_contents($this->template.'/'.$expected.'.phtml'), file_get_contents($file));

    }
}
