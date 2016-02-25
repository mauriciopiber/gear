<?php
namespace GearTest\ConstructorTest\AppTest;

use GearTest\ControllerTest\AbstractConsoleControllerTestCase;

/**
 * @group Controller
 */
class AppController extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->appController = new \Gear\Constructor\App\AppController();
    }
/*
    public function testCreateAction()
    {
        $resp = $this->appController->createAction();
        $this->assertInstanceOf('Zend\View\Model\ConsoleModel', $resp);
    }


    public function testDispatchCreate()
    {


        $this->dispatch('gear app-controller create');
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerName('Gear\Constructor\App\AppController');
        $this->assertActionName('create');
        $this->assertControllerClass('AppController');
        $this->assertMatchedRouteName('gear-app-controller-create');
    }

    public function testSetAppService()
    {
        $mockService = $this->getMockSingleClass('Gear\Constructor\App\AppService');
        $this->appController->setAppService($mockService);

        $this->assertEquals($mockService, $this->appController->getAppService());
    }

    public function testGetAppService()
    {
        $mockService = $this->getMockSingleClass('Gear\Constructor\App\AppService');

        //Localizador de Serviços
        $serviceLocator = new \Zend\ServiceManager\ServiceManager();
        $serviceLocator->setService('Gear\Constructor\App\AppService', $mockService);

        $this->appController->setServiceLocator($serviceLocator);

        $this->assertEquals($mockService, $this->appController->getAppService());
    }

    public function testDeleteAction()
    {
        $resp = $this->appController->deleteAction();
        $this->assertInstanceOf('Zend\View\Model\ConsoleModel', $resp);
    }

/*
    public function testDispatchDelete()
    {
        $this->dispatch('gear app-controller delete');
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerName('Gear\Constructor\App\AppController');
        $this->assertActionName('delete');
        $this->assertControllerClass('AppController');
        $this->assertMatchedRouteName('gear-app-controller-delete');
    }
*/
}
