<?php
namespace GearTest\ServiceTest\ConstructorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Constructor\Controller\ControllerService;
use GearJson\Controller\Controller;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
use Gear\Column\ColumnManager;

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

        $this->tableService = $this->prophesize('Gear\Table\TableService\TableService');
        $this->columnService = $this->prophesize('Gear\Column\ColumnService');

        $this->languageService = $this->prophesize('Gear\Mvc\LanguageService');

        $this->viewService = $this->prophesize('Gear\Mvc\View\ViewService');

        $this->configService = $this->prophesize('Gear\Mvc\Config\ConfigService');

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
