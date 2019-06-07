<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerMvcTest\ControllerMvcGeneratorTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGeneratorTrait;

/**
 * @group Gear
 * @group ControllerMvcGenerator
 * @group Service
 */
class ControllerMvcGeneratorTraitTest extends TestCase
{

    use ControllerMvcGeneratorTrait;

    public function testGet()
    {
        $serviceLocator = $this->getControllerMvcGenerator();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator')->reveal();
        $this->setControllerMvcGenerator($mocking);
        $this->assertEquals($mocking, $this->getControllerMvcGenerator());
    }
}
