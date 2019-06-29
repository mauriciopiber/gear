<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerGeneratorTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator;
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
        $mocking = $this->prophesize(ControllerGenerator::class)->reveal();
        $this->setControllerGenerator($mocking);
        $this->assertEquals($mocking, $this->getControllerGenerator());
    }
}
