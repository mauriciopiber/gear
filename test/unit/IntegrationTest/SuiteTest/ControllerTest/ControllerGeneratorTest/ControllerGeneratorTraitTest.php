<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerGeneratorTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGeneratorTrait;

/**
 * @group Gear
 * @group ControllerGenerator
 * @group Service
 */
class ControllerGeneratorTraitTest extends TestCase
{

    use ControllerGeneratorTrait;

    public function testGet()
    {
        $serviceLocator = $this->getControllerGenerator();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator')->reveal();
        $this->setControllerGenerator($mocking);
        $this->assertEquals($mocking, $this->getControllerGenerator());
    }
}
