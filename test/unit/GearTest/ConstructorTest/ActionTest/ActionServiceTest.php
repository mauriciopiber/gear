<?php
namespace GearTest\ServiceTest\ConstructorTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\Action\ActionService;

/**
 * @group module
 * @group Constructor
 * @group ConstructorAction
 */
class ActionServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->moduleName = 'Gearing';

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn($this->moduleName)->shouldBeCalled();

        $this->mvcController = $this->prophesize('Gear\Mvc\Controller\ControllerService');
        $this->mvcControllerTest = $this->prophesize('Gear\Mvc\Controller\ControllerTestService');

        $this->mvcConsoleController = $this->prophesize('Gear\Mvc\ConsoleController\ConsoleController');
        $this->mvcConsoleControllerTest = $this->prophesize('Gear\Mvc\ConsoleController\ConsoleControllerTest');

        $this->controllerManager = $this->prophesize('Gear\Mvc\Config\ControllerManager');


        $this->schemaAction = $this->prophesize('GearJson\Action\ActionService');

        $this->stringService = new \GearBase\Util\String\StringService();


        $this->viewService = $this->prophesize('Gear\Mvc\View\ViewService');

        $this->routerManager = $this->prophesize('Gear\Mvc\Config\RouterManager');

        $this->navigationManager = $this->prophesize('Gear\Mvc\Config\NavigationManager');
    }


    /**
     * @group Constructor
     * @group ConstructorAction
     */
    public function testCreateActionController()
    {
        $arrayController = [
            'name' => 'MyController',
            'type' => 'Action',
            'object' => '%s\Controller\MyController'
        ***REMOVED***;

        $arrayAction = [
            'name' => 'MyAction',
            'controller' => 'MyController'
        ***REMOVED***;

        $action = new \GearJson\Action\Action($arrayAction);

        $this->schemaAction->create('Gearing', 'MyController', 'MyAction', null, null, null, null, null)
        ->willReturn($action)
        ->shouldBeCalled();

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $this->schemaService->getController('Gearing', 'MyController')->willReturn($arrayController)->shouldBeCalled();

        $this->schemaAction->getSchemaService()->willReturn($this->schemaService->reveal())->shouldBeCalled();

        $this->viewService->build($action)->willReturn(true)->shouldBeCalled();
        $this->routerManager->create($action)->willReturn(true)->shouldBeCalled();
        $this->navigationManager->create($action)->willReturn(true)->shouldBeCalled();

        $this->mvcController->build($action)->willReturn(true)->shouldBeCalled();
        $this->mvcControllerTest->build($action)->willReturn(true)->shouldBeCalled();
        $this->controllerManager->create($action)->willReturn(true)->shouldBeCalled();


        $this->actionService = new ActionService();
        $this->actionService->setModule($this->module->reveal());
        $this->actionService->setActionService($this->schemaAction->reveal());
        $this->actionService->setStringService($this->stringService);
        $this->actionService->setMvcController($this->mvcController->reveal());
        $this->actionService->setControllerTestService($this->mvcControllerTest->reveal());
        $this->actionService->setViewService($this->viewService->reveal());
        $this->actionService->setRouterManager($this->routerManager->reveal());
        $this->actionService->setNavigationManager($this->navigationManager->reveal());

        $this->assertTrue($this->actionService->createControllerAction($arrayAction));
        /**

        $this->actionService->setConsoleController($this->mvcConsoleController->reveal());
        $this->actionService->setConsoleControllerTest($this->mvcConsoleControllerTest->reveal());
        $this->actionService->setControllerManager($this->controllerManager->reveal());
        $this->actionService->setactionService($this->schemaController->reveal());


        */
        //


    }

    /*
    public function setUp()
    {
        parent::setUp();
        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $this->module = $this->getMockSingleClass('Gear\Module\BasicModuleStructure', array('getModuleName'));
        $this->module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');

        $this->getActionConstructor()->setModule($this->module);

        $this->schemaJson = file_get_contents(__DIR__.'/_include/schema-controller.json');
    }


    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    public function testCreateActionInvalid()
    {
        $action = $this->getActionConstructor()->createControllerAction(array());
        $this->assertFalse($action);
    }
    */
}
