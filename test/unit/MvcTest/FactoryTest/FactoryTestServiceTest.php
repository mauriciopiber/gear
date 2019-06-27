<?php
namespace GearTest\MvcTest\FactoryTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\MvcTest\FactoryTest\FactoryDataTrait;
use Gear\Schema\Src\Src;
use Gear\Schema\Controller\Controller;
use GearTest\UtilTestTrait;
use Gear\Table\TableService\TableService;
use Gear\Code\FactoryCode\FactoryCodeTest;

/**
 * @group db-factory
 */
class FactoryTestServiceTest extends TestCase
{
    use UtilTestTrait;

    use FactoryDataTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../view');

        $this->template = $this->baseDir.'/../test/template/module/mvc/factory-test';

        $this->string  = new \Gear\Util\String\StringService();
        $fileCreator    = $this->createFileCreator();

        $this->codeFactoryTest = new FactoryCodeTest(
            $this->module->reveal(),
            $this->string,
            new \Gear\Util\Dir\DirService(),
            new \Gear\Util\Vector\ArrayService()
        );

        $this->factoryTest = new \Gear\Mvc\Factory\FactoryTestService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->createCodeTest(),
            $this->prophesize(TableService::class)->reveal(),
            $this->createInjector(),
            $this->codeFactoryTest
        );
    }

    /**
     * @group fix-dependency3
     */
    public function testCreateConsoleTestWithSpecialDependency()
    {
        $location = vfsStream::url('module');

        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestUnitModuleFolder()->willReturn($location)->shouldBeCalled();

        $data = new Controller(require __DIR__.'/../_gearfiles/console-with-special-dependency.php');

        $file = $this->factoryTest->createFactoryTest($data);

        $this->assertEquals(file_get_contents($this->template.'/controller/console-with-special-dependency.phtml'), file_get_contents($file));
    }

    /**
     * @group fix-dependency
     */
    public function testCreateServiceTestWithSpecialDependency()
    {
        $location = vfsStream::url('module');

        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestUnitModuleFolder()->willReturn($location);

        $data = new Src(require __DIR__.'/../_gearfiles/service-with-special-dependency.php');

        $file = $this->factoryTest->createFactoryTest($data);

        $this->assertEquals(file_get_contents($this->template.'/src/service-with-special-dependency.phtml'), file_get_contents($file));
    }

    /**
     * @group fix-dependency2
     */
    public function testCreateRepositoryTestWithSpecialDependency()
    {
        $location = vfsStream::url('module');

        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestUnitModuleFolder()->willReturn($location);

        $data = new Src(require __DIR__.'/../_gearfiles/repository-with-special-dependency.php');

        $file = $this->factoryTest->createFactoryTest($data);

        $this->assertEquals(file_get_contents($this->template.'/src/repository-with-special-dependency.phtml'), file_get_contents($file));
    }


    public function getData()
    {
        return $this->getFactoryData();
    }

    /**
     * @dataProvider getData
     * @group mvc
     * @group mvc-factory
     */
    public function testCreateFactoryForDb($data, $template)
    {
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        if ($data instanceof Src && $data->getTemplate() == 'form-filter') {

            $this->filter = $this->prophesize('Gear\Schema\Src\Src');
            $this->filter->getName()->willReturn('MyTableFilter');
            $this->filter->getType()->willReturn('Filter');
            $this->filter->getNamespace()->willReturn($data->getNamespace());


            $this->schema->getSrcByDb($data->getDb(), 'Filter')->willReturn($this->filter->reveal());

            $this->form = $this->prophesize('Gear\Schema\Src\Src');
            $this->form->getName()->willReturn('MyTableForm');
            $this->form->getType()->willReturn('Form');
            $this->form->getNamespace()->willReturn($data->getNamespace());


            $this->schema->getSrcByDb($data->getDb(), 'Form')->willReturn($this->form->reveal());

            /**
            $this->entity = $this->prophesize('Gear\Schema\Src\Src');
            $this->entity->getName()->willReturn('MyTable');
            $this->entity->getType()->willReturn('Entity');
            $this->entity->getNamespace()->willReturn(null);
            $this->schema->getSrcByDb($data->getDb(), 'Entity')->willReturn($this->entity);
            */
        }

        if ($data->getNamespace() === null) {
            $this->module->map(sprintf('%sTest', $data->getType()))->willReturn(vfsStream::url('module'))->shouldBeCalled();
        } else {
            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $file = $this->factoryTest->createFactoryTest($data);

        $this->assertEquals(
            file_get_contents($this->template.'/db/'.$template.'.phtml'),
            file_get_contents($file)
        );
    }
}
