<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcSuiteTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuiteTrait;

/**
 * @group Gear
 * @group ControllerMvcSuite
 * @group Service
 */
class ControllerMvcSuiteTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use ControllerMvcSuiteTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite');
        $serviceManager->setService('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getControllerMvcSuite();
        $this->assertInstanceOf('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite')->reveal();
        $this->setControllerMvcSuite($mocking);
        $this->assertEquals($mocking, $this->getControllerMvcSuite());
    }
}
