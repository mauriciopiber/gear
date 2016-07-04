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
        $this->consoleRouterManager = $this->prophesize('Gear\Mvc\Config\ConsoleRouterManager');

        $this->navigationManager = $this->prophesize('Gear\Mvc\Config\NavigationManager');

        $this->mvcConsoleController = $this->prophesize('Gear\Mvc\ConsoleController\ConsoleController');
        $this->mvcConsoleControllerTest = $this->prophesize('Gear\Mvc\ConsoleController\ConsoleControllerTest');

        $this->appController = $this->prophesize('Gear\Mvc\View\App\AppControllerService');

        $this->appControllerSpec = $this->prophesize('Gear\Mvc\View\App\AppControllerSpecService');

        $this->feature = $this->prophesize('Gear\Mvc\Spec\Feature\Feature');

        $this->page = $this->prophesize('Gear\Mvc\Spec\Page\Page');
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

        $controller = new \GearJson\Controller\Controller($arrayController);

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

        $this->mvcController->buildAction($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcControllerTest->buildAction($controller)->willReturn(true)->shouldBeCalled();

        $this->appController->build($action)->willReturn(true)->shouldBeCalled();
        $this->appControllerSpec->build($action)->willReturn(true)->shouldBeCalled();
        $this->feature->build($action)->willReturn(true)->shouldBeCalled();
        //$this->page->build($action)->willReturn(true)->shouldBeCalled();

        $this->actionService = new ActionService();
        $this->actionService->setModule($this->module->reveal());
        $this->actionService->setActionService($this->schemaAction->reveal());
        $this->actionService->setStringService($this->stringService);
        $this->actionService->setMvcController($this->mvcController->reveal());
        $this->actionService->setControllerTestService($this->mvcControllerTest->reveal());
        $this->actionService->setViewService($this->viewService->reveal());
        $this->actionService->setRouterManager($this->routerManager->reveal());
        $this->actionService->setNavigationManager($this->navigationManager->reveal());
        $this->actionService->setAppControllerService($this->appController->reveal());
        $this->actionService->setAppControllerSpecService($this->appControllerSpec->reveal());
        $this->actionService->setFeature($this->feature->reveal());
        $this->actionService->setPage($this->page->reveal());

        $this->assertTrue($this->actionService->createControllerAction($arrayAction));
    }

    /**
     * @group Constructor
     * @group ConstructorAction
     */
    public function testCreateConsoleController()
    {
        $arrayController = [
            'name' => 'MyController',
            'type' => 'Console',
            'object' => '%s\Controller\MyController'
        ***REMOVED***;

        $arrayAction = [
            'name' => 'MyAction',
            'controller' => 'MyController'
        ***REMOVED***;

        $controller = new \GearJson\Controller\Controller($arrayController);

        $action = new \GearJson\Action\Action($arrayAction);

        $this->schemaAction->create('Gearing', 'MyController', 'MyAction', null, null, null, null, null)
        ->willReturn($action)
        ->shouldBeCalled();

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $this->schemaService->getController('Gearing', 'MyController')->willReturn($arrayController)->shouldBeCalled();

        $this->schemaAction->getSchemaService()->willReturn($this->schemaService->reveal())->shouldBeCalled();


        $this->mvcConsoleController->buildAction($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcConsoleControllerTest->buildAction($controller)->willReturn(true)->shouldBeCalled();


        $this->consoleRouterManager->create($action)->willReturn(true)->shouldBeCalled();

        $this->actionService = new ActionService();
        $this->actionService->setModule($this->module->reveal());
        $this->actionService->setActionService($this->schemaAction->reveal());
        $this->actionService->setStringService($this->stringService);
        $this->actionService->setConsoleController($this->mvcConsoleController->reveal());
        $this->actionService->setConsoleControllerTest($this->mvcConsoleControllerTest->reveal());
        $this->actionService->setConsoleRouterManager($this->consoleRouterManager->reveal());

        $this->assertTrue($this->actionService->createControllerAction($arrayAction));
    }
}
