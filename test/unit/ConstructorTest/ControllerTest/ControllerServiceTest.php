<?php
namespace GearTest\ServiceTest\ConstructorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Constructor\Controller\ControllerService;
use GearJson\Controller\Controller;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
use Gear\Column\ColumnManager;
use Gear\Module\BasicModuleStructure;
use Gear\Mvc\Controller\Web\WebControllerService;
use Gear\Mvc\Controller\Web\WebControllerTestService;
use Gear\Mvc\ConsoleController\ConsoleController;
use Gear\Mvc\ConsoleController\ConsoleControllerTest;
use Gear\Mvc\Controller\Api\{ApiControllerService, ApiControllerTestService};
use Gear\Mvc\Config\ControllerManager;
use GearJson\Controller\ControllerService as SchemaController;
use Gear\Table\TableService\TableService;
use Gear\Column\ColumnService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\Config\ConfigService;
use GearBase\Util\String\StringService;

/**
 * @group m1
 */
class ControllerServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->moduleName = 'Gearing';

        $this->module = $this->prophesize(BasicModuleStructure::class);
        $this->module->getModuleName()->willReturn($this->moduleName)->shouldBeCalled();

        $this->mvcController = $this->prophesize(WebControllerService::class);
        $this->mvcControllerTest = $this->prophesize(WebControllerTestService::class);

        $this->mvcConsoleController = $this->prophesize(ConsoleController::class);
        $this->mvcConsoleControllerTest = $this->prophesize(ConsoleControllerTest::class);

        $this->apiControllerService = $this->prophesize(ApiControllerService::class);
        $this->apiControllerTestService = $this->prophesize(ApiControllerTestService::class);

        $this->controllerManager = $this->prophesize(ControllerManager::class);


        $this->schemaController = $this->prophesize(SchemaController::class);

        $this->stringService = new StringService();

        $this->tableService = $this->prophesize(TableService::class);
        $this->columnService = $this->prophesize(ColumnService::class);

        $this->languageService = $this->prophesize(LanguageService::class);

        $this->viewService = $this->prophesize(ViewService::class);

        $this->configService = $this->prophesize(ConfigService::class);


        $this->controllerService = new ControllerService(
            $this->stringService,
            $this->schemaController->reveal(),
            $this->tableService->reveal(),
            $this->columnService->reveal(),
            $this->module->reveal(),
            $this->mvcController->reveal(),
            $this->mvcControllerTest->reveal(),
            $this->mvcConsoleController->reveal(),
            $this->mvcConsoleControllerTest->reveal(),
            $this->apiControllerService->reveal(),
            $this->apiControllerTestService->reveal(),
            //$this->controllerManager->reveal(),
            $this->configService->reveal(),
            $this->viewService->reveal(),
            $this->languageService->reveal(),
            $this->controllerManager->reveal()
        );

    }

    /**
     * @group px1p
     */
    public function testCreateActionDbController()
    {
        $this->db = $this->prophesize('GearJson\Db\Db');
        $this->db->getTable()->willReturn('My')->shouldBeCalled();

        $this->controller = $this->prophesize('GearJson\Controller\Controller');
        $this->controller->getDb()->willReturn($this->db->reveal())->shouldBeCalled();
        $this->controller->getType()->willReturn('Action')->shouldBeCalled();

        $this->schemaController->create(
            'Gearing',
            [
                'name' => 'MyController',
                //'service' => 'factories',
                'type' => 'Action',
            ***REMOVED***,
            false
        )->willReturn($this->controller->reveal())->shouldBeCalled();

        $this->tableObject = $this->prophesize('Zend\Db\Metadata\Object\TableObject');
        $this->tableService->getTableObject('My')->willReturn($this->tableObject->reveal())->shouldBeCalled();
        $this->db->setTableObject($this->tableObject->reveal())->shouldBeCalled();

        $columnManager = $this->prophesize(ColumnManager::class);
        $this->columnService->getColumnManager($this->db->reveal())->willReturn($columnManager->reveal())->shouldBeCalled();

        $this->db->setColumnManager($columnManager->reveal())->shouldBeCalled();


        $this->configService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->mvcController->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->mvcControllerTest->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->viewService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->languageService->introspectFromTable($this->db->reveal())->shouldBeCalled();

        $array = [
            'name' => 'MyController',
            'type' => 'Action',
        ***REMOVED***;

        $this->assertTrue($this->controllerService->createController($array));

    }

    /**
     * @group px2p
     */
    public function testCreateControllerReturnNullWithoutAType()
    {
        $this->controller = $this->prophesize('GearJson\Controller\Controller');

        //$this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);

        $this->schemaController->create(
            'Gearing',
            [
                'name' => 'MyController',
                'service' => 'factories',
                'type' => 'Actxion',
            ***REMOVED***,
            false
        )->willReturn($this->controller->reveal())->shouldBeCalled();

        $array = [
            'name' => 'MyController',
            'service' => 'factories',
            'type' => 'Actxion',
        ***REMOVED***;

        $this->assertFalse($this->controllerService->createController($array));
    }

    /**
     * @group px3p
     */
    public function testCreateControllerReturnValidation()
    {
        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);

        $this->schemaController->create(
            "Gearing",
            [
                'name' => 'MyController',
                'service' => 'factories',
                'type' => 'Action',
            ***REMOVED***,
            false
        )->willReturn($this->consoleValidation->reveal())->shouldBeCalled();

        $array = [
            'name' => 'MyController',
            'service' => 'factories',
            'type' => 'Action',
        ***REMOVED***;

        $this->assertEquals($this->consoleValidation->reveal(), $this->controllerService->createController($array));
    }

    /**
     * @group Constructor
     * @group ConstructorController
     * @group px4p
     */
    public function testCreateConsoleController()
    {
        $array = [
            'name' => 'MyController',
            'type' => 'Console',
            'service' => 'factories'
        ***REMOVED***;

        $controller = new Controller($array);

        $this->mvcConsoleController->buildController($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcConsoleControllerTest->buildController($controller)->willReturn(true)->shouldBeCalled();
        $this->controllerManager->create($controller)->willReturn(true)->shouldBeCalled();

        $this->schemaController->create(
            'Gearing',
            [
                'name' => 'MyController',
                'service' => 'factories',
                'type' => 'Console',
            ***REMOVED***,
            false
       )->willReturn($controller)->shouldBeCalled();

       $this->assertTrue($this->controllerService->createController($array));
    }

    /**
     * @group px5p
     */
    public function testCreateController()
    {
        $array = [
            'name' => 'MyController',
            'type' => 'Action',
            'service' => 'factories'
            //'object' => '%s\Controller\MyController'
        ***REMOVED***;


        $controller = new Controller($array);

        $this->mvcController->buildController($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcControllerTest->buildController($controller)->willReturn(true)->shouldBeCalled();
        $this->controllerManager->create($controller)->willReturn(true)->shouldBeCalled();

        $this->schemaController->create(
            "Gearing",
            [
                'name' => 'MyController',
                'service' => 'factories',
                'type' => 'Action',
            ***REMOVED***,
            false
       )->willReturn($controller)->shouldBeCalled();

        $this->assertTrue($this->controllerService->createController($array));
    }
}
