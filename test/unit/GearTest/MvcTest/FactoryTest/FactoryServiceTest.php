<?php
namespace GearTest\MvcTest\Factory;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\MvcTest\FactoryTest\FactoryDataTrait;
use GearJson\Src\Src;
use GearJson\Controller\Controller;
use Gear\Creator\Component\Constructor\ConstructorParams;

/**
 * @group db-factory
 */
class FactoryServiceTest extends AbstractTestCase
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

        $this->template = $this->baseDir.'/../../test/template/module/mvc/factory';

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $this->string  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\File($fileService, $template);

        $code = new \Gear\Creator\Code();
        $code->setModule($this->module->reveal());
        $code->setStringService($this->string);
        $code->setDirService(new \GearBase\Util\Dir\DirService());
        $constructorParams = new ConstructorParams($this->string);
        $code->setConstructorParams($constructorParams);

        $this->factory = new \Gear\Mvc\Factory\FactoryService();
        $this->factory->setStringService($this->string);
        $this->factory->setFileCreator($fileCreator);
        $this->factory->setModule($this->module->reveal());
        $this->factory->setCode($code);

        $this->serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $this->serviceManager->setModule($this->module->reveal());
        $this->factory->setServiceManager($this->serviceManager);

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->factory->setSchemaService($this->schema->reveal());
    }

    /**
     * @group fix-dependency3
     */
    public function testCreateConsoleWithSpecialDependency()
    {
        $location = vfsStream::url('module');

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

        /**
        if ($data instanceof Src && $data->getTemplate() == 'search-form') {


            $this->filter = $this->prophesize('GearJson\Src\Src');
            $this->filter->getName()->willReturn('MyTableFilter');
            $this->filter->getType()->willReturn('Filter');

            $this->schema->getSrcByDb($data->getDb(), 'Filter')->willReturn($this->filter->reveal());

            $this->form = $this->prophesize('GearJson\Src\Src');
            $this->form->getName()->willReturn('MyTableForm');
            $this->form->getType()->willReturn('Form');
            $this->schema->getSrcByDb($data->getDb(), 'Form')->willReturn($this->form);

            $this->entity = $this->prophesize('GearJson\Src\Src');
            $this->entity->getName()->willReturn('MyTableEntity');
            $this->entity->getType()->willReturn('Entity');
            $this->schema->getSrcByDb($data->getDb(), 'Entity')->willReturn($this->entity);
        }*/

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


            $this->schema->getSrcByDb($data->getDb(), 'Form')->willReturn($this->form);

            $this->entity = $this->prophesize('GearJson\Src\Src');
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


        $expected = 'dependencies';

        $src = new \GearJson\Src\Src([
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