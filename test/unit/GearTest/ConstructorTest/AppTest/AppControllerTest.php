<?php
namespace GearTest\ConstructorTest\AppTest;

use GearTest\ControllerTest\AbstractConsoleControllerTestCase;

/**
 * @group Controller
 */
class AppControllerTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->appController = new \Gear\Constructor\App\AppController();
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

}
