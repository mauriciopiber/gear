<?php
namespace GearTest\MvcTest\ConfigTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Config\NavigationManagerTrait;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * @group Mvc
 * @group Mvc-Config
 * @group Config
 * @group Navigation
 */
class NavigationManagerTest extends AbstractTestCase
{
    use NavigationManagerTrait;

    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');
        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config/ext')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/config/ext');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getConfigExtFolder()->willReturn(vfsStream::url('module/config/ext'))->shouldBeCalled();
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->templates = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/config/navigation';

        $this->navigation = new \Gear\Mvc\Config\NavigationManager();
        $this->navigation->setFileCreator($this->fileCreator);
        $this->navigation->setStringService($this->string);
    }

    public function testModule()
    {
        $controllers = ["MyModule\Controller\IndexController" => "MyModule\Controller\IndexControllerFactory"***REMOVED***;

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->navigation->setModule($this->module->reveal());

        $file = $this->navigation->module($controllers);

        $this->assertEquals(
            file_get_contents($this->templates.'/navigation.module.phtml'),
            file_get_contents($file)
        );
    }

    public function testCreateAction()
    {
        $actualFile = $this->templates.'/navigation.module.phtml';

        file_put_contents(vfsStream::url('module/config/ext/navigation.config.php'), file_get_contents($actualFile));

        $controller = new \GearJson\Controller\Controller(
            [
                'name' => 'MyController',
                'object' => '%s\Controller\MyController'
            ***REMOVED***
        );

        $action = new \GearJson\Action\Action(
            [
                'controller' => $controller,
                'name' => 'MyAction'
            ***REMOVED***
        );

        $this->array = new \Gear\Util\Vector\ArrayService();
        //$this->array->setStringService($this->string);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->navigation->setModule($this->module->reveal());
        $this->navigation->setArrayService($this->array);

        $file = $this->navigation->create($action);

        $this->assertEquals(
            file_get_contents($this->templates.'/navigation.action.phtml'),
            file_get_contents($file)
        );
    }

    public function testDbAction()
    {
        $actualFile = $this->templates.'/navigation.module.phtml';

        file_put_contents(vfsStream::url('module/config/ext/navigation.config.php'), file_get_contents($actualFile));

        $db = new \GearJson\Db\Db(['table' => 'Table'***REMOVED***);

        $controller = new \GearJson\Controller\Controller(
            [
                'name' => 'TableController',
                'object' => '%s\Controller\TabkeController'
            ***REMOVED***
                //'actions' =>
        );
        $actions = [
            [
                'name' => 'Create',
                'db' => $db,
                'controller' => $controller
            ***REMOVED***,
            [
                'name' => 'Edit',
                'db' => $db,
                'controller' => $controller
            ***REMOVED***,
            [
                'name' => 'List',
                'db' => $db,
                'controller' => $controller
            ***REMOVED***,
            [
                'name' => 'Delete',
                'db' => $db,
                'controller' => $controller
            ***REMOVED***,
            [
                'name' => 'View',
                'db' => $db,
                'controller' => $controller
            ***REMOVED***
        ***REMOVED***;

        foreach ($actions as $action) {
            $controller->addAction(new \GearJson\Action\Action($action));
        }






        $this->array = new \Gear\Util\Vector\ArrayService();
        //$this->array->setStringService($this->string);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->navigation->setModule($this->module->reveal());
        $this->navigation->setArrayService($this->array);

        $file = $this->navigation->createDb($controller->getActions());

        $this->assertEquals(
            file_get_contents($this->templates.'/navigation.table.phtml'),
            file_get_contents($file)
        );
    }
}