<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite;
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
        $mocking = $this->prophesize(ControllerMvcSuite::class)->reveal();
        $this->setControllerMvcSuite($mocking);
        $this->assertEquals($mocking, $this->getControllerMvcSuite());
    }
}
