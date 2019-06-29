<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuiteTrait;

/**
 * @group Gear
 * @group ControllerSuite
 * @group Service
 */
class ControllerSuiteTraitTest extends TestCase
{

    use ControllerSuiteTrait;

    public function testGet()
    {
        $serviceLocator = $this->getControllerSuite();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize(ControllerSuite::class)->reveal();
        $this->setControllerSuite($mocking);
        $this->assertEquals($mocking, $this->getControllerSuite());
    }
}
