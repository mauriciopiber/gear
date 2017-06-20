<?php
namespace GearTest\ServiceTest\ConstructorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Constructor\Controller\ControllerService;
use GearJson\Controller\Controller;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;

/**
 * @group m1
 */
class ControllerServiceTest extends TestCase
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


        $this->schemaController = $this->prophesize('GearJson\Controller\ControllerService');

        $this->stringService = new \GearBase\Util\String\StringService();

        $this->controllerService = new ControllerService();
        $this->controllerService->setModule($this->module->reveal());
        $this->controllerService->setConsoleController($this->mvcConsoleController->reveal());
        $this->controllerService->setConsoleControllerTest($this->mvcConsoleControllerTest->reveal());
        $this->controllerService->setControllerManager($this->controllerManager->reveal());
        $this->controllerService->setControllerService($this->schemaController->reveal());
        $this->controllerService->setStringService($this->stringService);
        $this->controllerService->setMvcController($this->mvcController->reveal());
        $this->controllerService->setControllerTestService($this->mvcControllerTest->reveal());

        $this->tableService = $this->prophesize('Gear\Table\TableService\TableService');
        $this->controllerService->setTableService($this->tableService->reveal());

        $this->languageService = $this->prophesize('Gear\Mvc\LanguageService');
        $this->controllerService->setLanguageService($this->languageService->reveal());

        $this->viewService = $this->prophesize('Gear\Mvc\View\ViewService');
        $this->controllerService->setViewService($this->viewService->reveal());

        $this->configService = $this->prophesize('Gear\Mvc\Config\ConfigService');
        $this->controllerService->setConfigService($this->configService->reveal());

    }

    /**
     * @group p1
     */
    public function testCreateActionDbController()
    {
        $this->db = $this->prophesize('GearJson\Db\Db');
        $this->db->getTable()->willReturn('My')->shouldBeCalled();

        $this->controller = $this->prophesize('GearJson\Controller\Controller');
        $this->controller->getDb()->willReturn($this->db->reveal())->shouldBeCalled();
        $this->controller->getType()->willReturn('Action')->shouldBeCalled();

        $this->schemaController->create(
            "Gearing",
            "MyController",
            "factories",
            "Action",
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            false
        )->willReturn($this->controller->reveal())->shouldBeCalled();

        $this->tableObject = $this->prophesize('Zend\Db\Metadata\Object\TableObject');
        $this->tableService->getTableObject('My')->willReturn($this->tableObject->reveal())->shouldBeCalled();
        $this->db->setTableObject($this->tableObject->reveal())->shouldBeCalled();

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
     * @group x1
     */
    public function testCreateControllerReturnNullWithoutAType()
    {
        $this->controller = $this->prophesize('GearJson\Controller\Controller');

        //$this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);

        $this->schemaController->create(
            "Gearing",
            "MyController",
            "factories",
            "Actxion",
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            false
        )->willReturn($this->controller->reveal())->shouldBeCalled();

        $array = [
            'name' => 'MyController',
            'type' => 'Actxion',
        ***REMOVED***;

        $this->assertFalse($this->controllerService->createController($array));
    }

    /**
     * @group x1
     */
    public function testCreateControllerReturnValidation()
    {
        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);

        $this->schemaController->create(
            "Gearing",
            "MyController",
            "factories",
            "Action",
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            false
        )->willReturn($this->consoleValidation->reveal())->shouldBeCalled();

        $array = [
            'name' => 'MyController',
            'type' => 'Action',
        ***REMOVED***;

        $this->assertEquals($this->consoleValidation->reveal(), $this->controllerService->createController($array));
    }

    /**
     * @group Constructor
     * @group ConstructorController
     */
    public function testCreateConsoleController()
    {
        $array = [
            'name' => 'MyController',
            'type' => 'Console',
            'object' => '%s\Controller\MyController'
        ***REMOVED***;


        $controller = new Controller($array);

        $this->mvcConsoleController->buildController($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcConsoleControllerTest->buildController($controller)->willReturn(true)->shouldBeCalled();
        $this->controllerManager->create($controller)->willReturn(true)->shouldBeCalled();

        $this->schemaController->create(
            "Gearing",
            "MyController",
            "factories",
            "Console",
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            false
       )->willReturn($controller)->shouldBeCalled();

       $this->assertTrue($this->controllerService->createController($array));
    }

    public function testCreateController()
    {
        $array = [
            'name' => 'MyController',
            'type' => 'Action',
            'object' => '%s\Controller\MyController'
        ***REMOVED***;


        $controller = new Controller($array);

        $this->mvcController->buildController($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcControllerTest->buildController($controller)->willReturn(true)->shouldBeCalled();
        $this->controllerManager->create($controller)->willReturn(true)->shouldBeCalled();

        $this->schemaController->create(
            "Gearing",
            "MyController",
            "factories",
            "Action",
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            false
       )->willReturn($controller)->shouldBeCalled();

        $this->assertTrue($this->controllerService->createController($array));
    }

    /*
    public function testCreateControllerRest()
    {
        $array = [
            'name' => 'MyController',
            'type' => 'Restful',
            'object' => '%s\Controller\MyController'
        ***REMOVED***;

        $controller = new Controller($array);

        $this->schemaController->create(
            "Gearing",
            "MyController",
            "factories",
            "Restful",
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            false
       )->willReturn($controller)->shouldBeCalled();

        $this->controllerService = new ControllerService();
        $this->controllerService->setModule($this->module->reveal());
        $this->controllerService->setControllerService($this->schemaController->reveal());
        $this->controllerService->setStringService($this->stringService);

        $this->assertNull($this->controllerService->createController($array));
    }
    */
}
