<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class ConstructorControllerTest extends AbstractConsoleControllerTestCase
{
    const CONTROLLER = 'gear controller create %s --name=%s --invokable=%s';

    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__.'/../../../../../config/application.config.php');

        parent::setUp();

        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $controllerManager = $this->getApplication()
        ->getServiceManager()
        ->get('controllermanager');

        $this->constructorController = $controllerManager->get('Gear\Controller\Constructor');

        $mockProjectService = $this->getMockBuilder('Gear\Constructor\ControllerMaker')
        ->disableOriginalConstructor()
        ->getMock();

        $mockProjectService->expects($this->any())
        ->method('create')
        ->willReturn(true);

        $this->constructorController->setControllerConstructor($mockProjectService);

        //$this->testDir = realpath(__DIR__.'/../../temp');
    }

    public function tearDown()
    {
        parent::tearDown();
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
        unset($this->constructorController);
    }
    //controller
    //action
    //tests
    //page
    //src
    //db
    public function testCreateController()
    {
        //echo sprintf(self::CONTROLLER, 'Admin', 'MyController', '%s\Controller\My');
        $this->dispatch(sprintf(self::CONTROLLER, 'Admin', 'MyController', '%s\Controller\My'));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ConstructorController');
        $this->assertControllerName('Gear\Controller\Constructor');
        $this->assertActionName('controller');
        $this->assertMatchedRouteName('gear-controller');
        $this->assertResponseStatusCode(0);

    }
}