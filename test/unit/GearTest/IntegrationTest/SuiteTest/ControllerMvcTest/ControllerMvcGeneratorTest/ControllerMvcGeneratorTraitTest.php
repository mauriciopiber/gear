<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcGeneratorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGeneratorTrait;

/**
 * @group Gear
 * @group ControllerMvcGenerator
 * @group Service
 */
class ControllerMvcGeneratorTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use ControllerMvcGeneratorTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator');
        $serviceManager->setService('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getControllerMvcGenerator();
        $this->assertInstanceOf('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator')->reveal();
        $this->setControllerMvcGenerator($mocking);
        $this->assertEquals($mocking, $this->getControllerMvcGenerator());
    }
}
