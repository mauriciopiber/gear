<?php
namespace GearTest\ServiceTest\ConstructorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Module\BasicModuleStructure;
use Gear\Constructor\Action\ActionService;
use Gear\Mvc\Controller\ControllerService;
use Gear\Mvc\Controller\ControllerTestService;
use Gear\Mvc\ConsoleController\ConsoleController;
use Gear\Mvc\ConsoleController\ConsoleControllerTest;
use Gear\Mvc\Config\ControllerManager;
use GearJson\Action\ActionService as JsonActionService;
use GearBase\Util\String\StringService;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\Config\RouterManager;
use Gear\Mvc\Config\ConsoleRouterManager;
use Gear\Mvc\Config\NavigationManager;
use Gear\Mvc\View\App\AppControllerService;
use Gear\Mvc\View\App\AppControllerSpecService;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Mvc\Spec\Page\Page;
use Gear\Mvc\Spec\Step\Step;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\Db\Db;
use GearJson\Schema\SchemaService;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;

/**
 * @group m1
 */
class ActionServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->moduleName = 'Gearing';

        $this->module = $this->prophesize(BasicModuleStructure::class);
        $this->module->getModuleName()->willReturn($this->moduleName)->shouldBeCalled();


        //mvc controller
        $this->mvcController = $this->prophesize(ControllerService::class);
        $this->mvcControllerTest = $this->prophesize(ControllerTestService::class);
        $this->mvcConsoleController = $this->prophesize(ConsoleController::class);
        $this->mvcConsoleControllerTest = $this->prophesize(ConsoleControllerTest::class);

        //adicional
        $this->page = $this->prophesize(Page::class);
        $this->step = $this->prophesize(Step::class);
        $this->feature = $this->prophesize(Feature::class);
        $this->viewService = $this->prophesize(ViewService::class);
        $this->appController = $this->prophesize(AppControllerService::class);
        $this->appControllerSpec = $this->prophesize(AppControllerSpecService::class);

        //config
        $this->routerManager = $this->prophesize(RouterManager::class);
        $this->navigationManager = $this->prophesize(NavigationManager::class);
        $this->consoleRouterManager = $this->prophesize(ConsoleRouterManager::class);

        //schema
        $this->schemaAction = $this->prophesize(JsonActionService::class);
        $this->schemaService = $this->prophesize(SchemaService::class);

        $this->stringService = new StringService();

        $this->actionService = new ActionService(
            $this->schemaAction->reveal(),
            $this->routerManager->reveal(),
            $this->consoleRouterManager->reveal(),
            $this->navigationManager->reveal(),
            $this->viewService->reveal(),
            $this->mvcController->reveal(),
            $this->mvcControllerTest->reveal(),
            $this->mvcConsoleController->reveal(),
            $this->mvcConsoleControllerTest->reveal(),
            $this->appController->reveal(),
            $this->appControllerSpec->reveal(),
            $this->feature->reveal(),
            $this->page->reveal(),
            $this->step->reveal(),
            $this->module->reveal(),
            $this->stringService
        );

        /*
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
        $this->actionService->setConsoleController($this->mvcConsoleController->reveal());
        $this->actionService->setConsoleControllerTest($this->mvcConsoleControllerTest->reveal());
        $this->actionService->setConsoleRouterManager($this->consoleRouterManager->reveal());
        $this->actionService->setStep($this->step->reveal());
        */
    }

    /**
     * @group b1
     */
    public function testCreateActionControllerReturnConsoleValidation()
    {
        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);

        $this->schemaAction->create('Gearing', 'MyController', 'MyAction', null, null, null, null, null)
            ->willReturn($this->consoleValidation->reveal())
            ->shouldBeCalled();

        $arrayAction = [
            'name' => 'MyAction',
            'controller' => 'MyController'
        ***REMOVED***;

        $this->assertEquals($this->consoleValidation->reveal(), $this->actionService->createControllerAction($arrayAction));
    }

    /**
     * @group b2
     */
    public function testCreateActionControllerWithDb()
    {
        $arrayController = [
            'name' => 'MyController',
            'type' => 'Action'
        ***REMOVED***;

        $arrayAction = [
            'name' => 'MyAction',
            'controller' => 'MyController',
            'db' => 'MyTable'
        ***REMOVED***;

        $this->controller = new Controller($arrayController);

        $this->action = new Action($arrayAction);


        $this->db = new Db(['table' => 'MyTable'***REMOVED***);


        $this->controller->setDb($this->db);

        //$this->controller->getDb()->willReturn($this->db->reveal());
        $this->action->setController(new Controller([
            'name' => 'MyController',
            'type' => 'Action'
        ***REMOVED***));

        $this->schemaAction->create('Gearing', 'MyController', 'MyAction', null, null, null, 'MyTable', null)
            ->willReturn($this->action)
            ->shouldBeCalled();

        $this->schemaService->getController('Gearing', 'MyController')->willReturn($arrayController)->shouldBeCalled();
        $this->schemaAction->getSchemaService()->willReturn($this->schemaService->reveal())->shouldBeCalled();

        $this->viewService->build($this->action)->willReturn(true)->shouldBeCalled();
        $this->routerManager->create($this->action)->willReturn(true)->shouldBeCalled();
        $this->navigationManager->create($this->action)->willReturn(true)->shouldBeCalled();

        $this->mvcController->buildAction($this->controller)->willReturn(true)->shouldBeCalled();
        $this->mvcControllerTest->buildAction($this->controller)->willReturn(true)->shouldBeCalled();

        $this->appController->build($this->action)->willReturn(true)->shouldBeCalled();
        $this->appControllerSpec->build($this->action)->willReturn(true)->shouldBeCalled();
        $this->feature->build($this->action)->willReturn(true)->shouldBeCalled();

        $this->step->createTableStep($this->db)->willReturn(true)->shouldBeCalled();
        //$this->page->build($action)->willReturn(true)->shouldBeCalled();

        $this->assertTrue($this->actionService->createControllerAction($arrayAction));
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

        $controller = new Controller($arrayController);

        $action = new Action($arrayAction);

        $this->schemaAction->create('Gearing', 'MyController', 'MyAction', null, null, null, null, null)
            ->willReturn($action)
            ->shouldBeCalled();

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

        $controller = new Controller($arrayController);

        $action = new Action($arrayAction);

        $this->schemaAction->create('Gearing', 'MyController', 'MyAction', null, null, null, null, null)
        ->willReturn($action)
        ->shouldBeCalled();

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $this->schemaService->getController('Gearing', 'MyController')->willReturn($arrayController)->shouldBeCalled();

        $this->schemaAction->getSchemaService()->willReturn($this->schemaService->reveal())->shouldBeCalled();


        $this->mvcConsoleController->buildAction($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcConsoleControllerTest->buildAction($controller)->willReturn(true)->shouldBeCalled();


        $this->consoleRouterManager->create($action)->willReturn(true)->shouldBeCalled();


        $this->assertTrue($this->actionService->createControllerAction($arrayAction));
    }
}
