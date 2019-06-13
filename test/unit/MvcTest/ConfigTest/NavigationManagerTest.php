<?php
namespace GearTest\MvcTest\ConfigTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Config\NavigationManagerTrait;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use Gear\Schema\Controller\Controller;
use Gear\Schema\Action\Action;
use GearTest\UtilTestTrait;
use Gear\Creator\Code;
use Gear\Util\Vector\ArrayService;
use Gear\Mvc\LanguageService;

/**
 * @group Mvc
 * @group Mvc-Config
 * @group Config
 * @group Navigation
 */
class NavigationManagerTest extends TestCase
{
    use NavigationManagerTrait;

    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();

        vfsStream::setup('module');
        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config/ext')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/config/ext');

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->module->getConfigExtFolder()->willReturn(vfsStream::url('module/config/ext'))->shouldBeCalled();
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new \Gear\Util\String\StringService();

        $this->fileCreator    = $this->createFileCreator();

        $this->templates = (new \Gear\Module())->getLocation().'/../test/template/module/mvc/config/navigation';

        $this->navigation = new \Gear\Mvc\Config\NavigationManager(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->prophesize(Code::class)->reveal(),
            $this->prophesize(ArrayService::class)->reveal(),
            $this->prophesize(LanguageService::class)->reveal()
        );
        //$this->navigation->setFileCreator($this->fileCreator);
        //$this->navigation->setStringService($this->string);
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

    /**
     * @group scma

    public function testSimulateCreateManyActions()
    {
        $actualFile = $this->templates.'/navigation.module.phtml';
        file_put_contents(vfsStream::url('module/config/ext/navigation.config.php'), file_get_contents($actualFile));

        $controller = new Controller([
            'name' => 'MyController',
            'object' => '%s\Controller\MyController'
        ***REMOVED***);

        $action = new Action([
            'controller' => $controller,
            'name' => 'First'
        ***REMOVED***);

        $action2 = new Action([
            'controller' => $controller,
            'name' => 'Two'
        ***REMOVED***);

        $controller->addAction($action);
        $controller->addAction($action2);



        $this->array = new \Gear\Util\Vector\ArrayService();
        //$this->array->setStringService($this->string);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->navigation->setModule($this->module->reveal());
        $this->navigation->setArrayService($this->array);

        $this->navigation->create($action);
        $file = $this->navigation->create($action2);

        $this->assertEquals(
            file_get_contents($this->templates.'/navigation.many.action.phtml'),
            file_get_contents($file)
        );
    }
    */

    public function testCreateAction()
    {
        $actualFile = $this->templates.'/navigation.module.phtml';

        file_put_contents(vfsStream::url('module/config/ext/navigation.config.php'), file_get_contents($actualFile));

        $controller = new \Gear\Schema\Controller\Controller(
            [
                'name' => 'MyController',
                'object' => '%s\Controller\MyController'
            ***REMOVED***
        );

        $action = new \Gear\Schema\Action\Action(
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

        $db = new \Gear\Schema\Db\Db(['table' => 'Table'***REMOVED***);

        $controller = new \Gear\Schema\Controller\Controller(
            [
                'name' => 'TableController',
                'object' => '%s\Controller\TabkeController'
            ***REMOVED***
                //'actions' =>
        );
        $actions = [
            [
                'name' => 'Create',
                'controller' => $controller
            ***REMOVED***,
            [
                'name' => 'Edit',
                'controller' => $controller
            ***REMOVED***,
            [
                'name' => 'List',
                'controller' => $controller
            ***REMOVED***,
            [
                'name' => 'Delete',
                'controller' => $controller
            ***REMOVED***,
            [
                'name' => 'View',
                'controller' => $controller
            ***REMOVED***
        ***REMOVED***;

        $controller->setDb($db);

        foreach ($actions as $action) {
            $controller->addAction(new \Gear\Schema\Action\Action($action));
        }

        $this->array = new \Gear\Util\Vector\ArrayService();
        //$this->array->setStringService($this->string);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->navigation->setModule($this->module->reveal());
        $this->navigation->setArrayService($this->array);

        $file = $this->navigation->createDb($controller->getActions());
        $file = $this->navigation->createDb($controller->getActions());

        $this->assertEquals(
            file_get_contents($this->templates.'/navigation.table.phtml'),
            file_get_contents($file)
        );
    }
}
