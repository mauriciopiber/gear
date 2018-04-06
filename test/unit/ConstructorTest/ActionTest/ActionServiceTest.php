<?php
namespace GearTest\ServiceTest\ConstructorTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;
use Gear\Constructor\Action\ActionConstructor;
use Gear\Mvc\Controller\Web\WebControllerService;
use Gear\Mvc\Controller\Web\WebControllerTestService;
use Gear\Mvc\Controller\Console\{
    ConsoleControllerService,
    ConsoleControllerTestService,

};
use Gear\Mvc\Config\ControllerManager;
use GearJson\Action\ActionSchema;
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
use Zend\Db\Metadata\Object\TableObject;
use Gear\Column\ColumnManager;

/**
 * @group m1
 */
class ActionConstructorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->moduleName = 'Gearing';

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->module->getModuleName()->willReturn($this->moduleName);


        //mvc controller
        $this->mvcController = $this->prophesize(WebControllerService::class);
        $this->mvcControllerTest = $this->prophesize(WebControllerTestService::class);
        $this->mvcConsoleController = $this->prophesize(ConsoleControllerService::class);
        $this->mvcConsoleControllerTest = $this->prophesize(ConsoleControllerTestService::class);

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
        $this->actionSchema = $this->prophesize(ActionSchema::class);
        $this->schemaService = $this->prophesize(SchemaService::class);

        $this->stringService = new StringService();

        $this->tableService = $this->prophesize('Gear\Table\TableService\TableService');
        $this->columnService = $this->prophesize('Gear\Column\ColumnService');

        $this->actionService = new ActionConstructor(
            $this->actionSchema->reveal(),
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
            $this->stringService,
            $this->tableService->reveal(),
            $this->columnService->reveal()
        );
    }

    public function testCreateModule()
    {
        $this->actionSchema->create(
            $this->moduleName,
            [
                'controller' => 'IndexController',
                'name' => 'Index'
            ***REMOVED***,
            false
        )->shouldBeCalled();

        $this->viewService->createIndexView()->shouldBeCalled();
        $this->appControllerSpec->createTestIndexAction()->shouldBeCalled();
        $this->appController->createIndexController()->shouldBeCalled();
        $this->feature->createIndexFeature()->shouldBeCalled();
        $this->page->createIndexPage()->shouldBeCalled();
        $this->step->createIndexStep()->shouldBeCalled();

        $this->assertTrue($this->actionService->createModule('web'));
    }

    /**
     * @group pxp1
     */
    public function testCreateActionControllerReturnConsoleValidation()
    {
        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);

        $this->actionSchema->create(
            'Gearing',
            [
                'controller' => 'MyController',
                'name' => 'MyAction'
            ***REMOVED***,
            false
        )
        ->willReturn($this->consoleValidation->reveal())
        ->shouldBeCalled();

        $arrayAction = [
            'name' => 'MyAction',
            'controller' => 'MyController'
        ***REMOVED***;

        $this->assertEquals($this->consoleValidation->reveal(), $this->actionService->createControllerAction($arrayAction));
    }

    /**
     * @group pxp5
     */
    public function testCreateActionControllerWithDb()
    {
        $arrayController = [
            'name' => 'MyController',
            'type' => 'Action',
            'db' => 'MyTable'
        ***REMOVED***;

        $arrayAction = [
            'name' => 'MyAction',
            'controller' => 'MyController',

        ***REMOVED***;

        $controller = new Controller($arrayController);

        $action = new Action($arrayAction);
        $controller->setType('Action');
        $action->setController($controller);


        $this->actionSchema->create(
            'Gearing',
            [
                'controller' => 'MyController',
                'name' => 'MyAction'
            ***REMOVED***,
            false
        )
        ->willReturn($action)
        ->shouldBeCalled();

        //$this->db = new Db(['table' => 'MyTable'***REMOVED***);

        //$controller->setDb($this->db);

        $this->viewService->build($action)->willReturn(true)->shouldBeCalled();
        $this->routerManager->create($action)->willReturn(true)->shouldBeCalled();
        $this->navigationManager->create($action)->willReturn(true)->shouldBeCalled();

        $this->mvcController->buildAction($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcControllerTest->buildAction($controller)->willReturn(true)->shouldBeCalled();

        $this->appController->build($action)->willReturn(true)->shouldBeCalled();
        $this->appControllerSpec->build($action)->willReturn(true)->shouldBeCalled();
        $this->feature->build($action)->willReturn(true)->shouldBeCalled();

        $this->step->createTableStep($action->getController()->getDb())->willReturn(true)->shouldBeCalled();
        //$this->page->build($action)->willReturn(true)->shouldBeCalled();

        $tableObject = $this->prophesize(TableObject::class);

        $this->tableService->getTableObject('MyTable')->willReturn($tableObject->reveal())->shouldBeCalled();

        //$dbTwo->setTableObject($tableObjectTwo->reveal())->shouldBeCalled();

        $columnManager = $this->prophesize(ColumnManager::class);
        $this->columnService->getColumnManager($action->getController()->getDb())->willReturn($columnManager->reveal());
        //$dbTwo->setColumnManager($columnManagerTwo)->shouldBeCalled();

        $action->getController()->getDb()->setTableObject($tableObject->reveal());
        $action->getController()->getDb()->setColumnManager($columnManager->reveal());

        $this->assertTrue($this->actionService->createControllerAction($arrayAction));
    }


    /**
     * @group pxp4
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
        $controller->setType('Action');
        $action->setController($controller);

        $this->actionSchema->create(
            'Gearing',
            [
                'controller' => 'MyController',
                'name' => 'MyAction'
            ***REMOVED***,
            false
        )
        ->willReturn($action)
        ->shouldBeCalled();
        //$this->schemaService->getController('Gearing', 'MyController')->willReturn($arrayController)->shouldBeCalled();
        //$this->actionSchema->getSchemaService()->willReturn($this->schemaService->reveal())->shouldBeCalled();

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
     * @group pxp2
     * @group pxp3
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
        $controller->setType('Console');
        $action->setController($controller);

        $this->actionSchema->create(
            'Gearing',
            [
                'controller' => 'MyController',
                'name' => 'MyAction'
            ***REMOVED***,
            false
        )
        ->willReturn($action)
        ->shouldBeCalled();

        $this->mvcConsoleController->buildAction($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcConsoleControllerTest->buildAction($controller)->willReturn(true)->shouldBeCalled();

        $this->consoleRouterManager->create($action)->willReturn(true)->shouldBeCalled();

        $this->assertTrue($this->actionService->createControllerAction($arrayAction));
    }
}
