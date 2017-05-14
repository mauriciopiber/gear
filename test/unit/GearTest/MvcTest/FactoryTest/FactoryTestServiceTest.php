<?php
namespace GearTest\MvcTest\FactoryTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\MvcTest\FactoryTest\FactoryDataTrait;
use GearJson\Src\Src;
use GearJson\Controller\Controller;

/**
 * @group db-factory
 */
class FactoryTestServiceTest extends AbstractTestCase
{
    use FactoryDataTrait;

    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->template = $this->baseDir.'/../../test/template/module/mvc/factory-test';

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $stringService  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $codeTest = new \Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest();
        $codeTest->setModule($this->module->reveal());
        $codeTest->setDirService(new \GearBase\Util\Dir\DirService());

        $this->factoryTest = new \Gear\Mvc\Factory\FactoryTestService();
        $this->factoryTest->setStringService($stringService);
        $this->factoryTest->setFileCreator($fileCreator);
        $this->factoryTest->setModule($this->module->reveal());
        $this->factoryTest->setFactoryCodeTest($codeTest);

        $this->serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $this->serviceManager->setModule($this->module->reveal());
        $this->factoryTest->setServiceManager($this->serviceManager);

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->factoryTest->setSchemaService($this->schema->reveal());
    }

    /**
     * @group fix-dependency3
     */
    public function testCreateConsoleTestWithSpecialDependency()
    {
        $location = vfsStream::url('module');

        $this->module->getSrcModuleFolder()->willReturn($location);

        $data = new Controller(require __DIR__.'/../_gearfiles/console-with-special-dependency.php');

        $file = $this->factoryTest->createFactoryTest($data, $location);

        $this->assertEquals(file_get_contents($this->template.'/controller/console-with-special-dependency.phtml'), file_get_contents($file));
    }

    /**
     * @group fix-dependency
     */
    public function testCreateServiceTestWithSpecialDependency()
    {
        $location = vfsStream::url('module');

        $this->module->getSrcModuleFolder()->willReturn($location);

        $data = new Src(require __DIR__.'/../_gearfiles/service-with-special-dependency.php');

        $file = $this->factoryTest->createFactoryTest($data, $location);

        $this->assertEquals(file_get_contents($this->template.'/src/service-with-special-dependency.phtml'), file_get_contents($file));
    }

    /**
     * @group fix-dependency2
     */
    public function testCreateRepositoryTestWithSpecialDependency()
    {
        $location = vfsStream::url('module');

        $this->module->getSrcModuleFolder()->willReturn($location);

        $data = new Src(require __DIR__.'/../_gearfiles/repository-with-special-dependency.php');

        $file = $this->factoryTest->createFactoryTest($data, $location);

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
        if ($data instanceof Src && $data->getTemplate() == 'form-filter') {

            $this->filter = $this->prophesize('GearJson\Src\Src');
            $this->filter->getName()->willReturn('MyTableFilter');
            $this->filter->getType()->willReturn('Filter');
            $this->filter->getNamespace()->willReturn($data->getNamespace());


            $this->schema->getSrcByDb($data->getDb(), 'Filter')->willReturn($this->filter->reveal());

            $this->form = $this->prophesize('GearJson\Src\Src');
            $this->form->getName()->willReturn('MyTableForm');
            $this->form->getType()->willReturn('Form');
            $this->form->getNamespace()->willReturn($data->getNamespace());


            $this->schema->getSrcByDb($data->getDb(), 'Form')->willReturn($this->form->reveal());

            /**
            $this->entity = $this->prophesize('GearJson\Src\Src');
            $this->entity->getName()->willReturn('MyTable');
            $this->entity->getType()->willReturn('Entity');
            $this->entity->getNamespace()->willReturn(null);
            $this->schema->getSrcByDb($data->getDb(), 'Entity')->willReturn($this->entity);
            */
        }

        $file = $this->factoryTest->createFactoryTest($data, vfsStream::url('module'));

        $this->assertEquals(
            file_get_contents($this->template.'/db/'.$template.'.phtml'),
            file_get_contents($file)
        );
    }
}
