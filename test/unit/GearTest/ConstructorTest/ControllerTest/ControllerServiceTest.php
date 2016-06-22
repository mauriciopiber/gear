<?php
namespace GearTest\ServiceTest\ConstructorTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\Controller\ControllerService;

/**
 * @group module
 * @group ConstructorController
 */
class ControllerServiceTest extends AbstractTestCase
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
        //controller
        //controllerTest
        //consoleController
        //consoleControllerTest
        //controllerManager
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


        $controller = new \GearJson\Controller\Controller($array);

        $this->mvcConsoleController->build($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcConsoleControllerTest->build($controller)->willReturn(true)->shouldBeCalled();
        $this->controllerManager->create($controller)->willReturn(true)->shouldBeCalled();

        $this->schemaController->create(
            "Gearing",
            "MyController",
            "factories",
            "Console",
            null,
            null
       )->willReturn($controller)->shouldBeCalled();

        $this->controllerService = new ControllerService();
        $this->controllerService->setModule($this->module->reveal());
        $this->controllerService->setConsoleController($this->mvcConsoleController->reveal());
        $this->controllerService->setConsoleControllerTest($this->mvcConsoleControllerTest->reveal());
        $this->controllerService->setControllerManager($this->controllerManager->reveal());
        $this->controllerService->setControllerService($this->schemaController->reveal());
        $this->controllerService->setStringService($this->stringService);

        $this->assertTrue($this->controllerService->createController($array));


    }

    public function testCreateController()
    {
        $array = [
            'name' => 'MyController',
            'type' => 'Action',
            'object' => '%s\Controller\MyController'
        ***REMOVED***;


        $controller = new \GearJson\Controller\Controller($array);

        $this->mvcController->build($controller)->willReturn(true)->shouldBeCalled();
        $this->mvcControllerTest->build($controller)->willReturn(true)->shouldBeCalled();
        $this->controllerManager->create($controller)->willReturn(true)->shouldBeCalled();

        $this->schemaController->create(
            "Gearing",
            "MyController",
            "factories",
            "Action",
            null,
            null
       )->willReturn($controller)->shouldBeCalled();

        $this->controllerService = new ControllerService();
        $this->controllerService->setModule($this->module->reveal());
        $this->controllerService->setMvcController($this->mvcController->reveal());
        $this->controllerService->setControllerTestService($this->mvcControllerTest->reveal());
        $this->controllerService->setControllerManager($this->controllerManager->reveal());
        $this->controllerService->setControllerService($this->schemaController->reveal());
        $this->controllerService->setStringService($this->stringService);

        $this->assertTrue($this->controllerService->createController($array));
    }


    public function testCreateControllerRest()
    {
        $array = [
            'name' => 'MyController',
            'type' => 'Restful',
            'object' => '%s\Controller\MyController'
        ***REMOVED***;


        $controller = new \GearJson\Controller\Controller($array);

        $this->schemaController->create(
            "Gearing",
            "MyController",
            "factories",
            "Restful",
            null,
            null
       )->willReturn($controller)->shouldBeCalled();

        $this->controllerService = new ControllerService();
        $this->controllerService->setModule($this->module->reveal());
        $this->controllerService->setControllerService($this->schemaController->reveal());
        $this->controllerService->setStringService($this->stringService);

        $this->assertNull($this->controllerService->createController($array));
    }


}
