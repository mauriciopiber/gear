<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuiteTrait;

/**
 * @group Gear
 * @group ControllerMvcSuite
 * @group Service
 */
class ControllerMvcSuiteTraitTest extends TestCase
{

    use ControllerMvcSuiteTrait;

    public function testGet()
    {
        $serviceLocator = $this->getControllerMvcSuite();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite')->reveal();
        $this->setControllerMvcSuite($mocking);
        $this->assertEquals($mocking, $this->getControllerMvcSuite());
    }
}
