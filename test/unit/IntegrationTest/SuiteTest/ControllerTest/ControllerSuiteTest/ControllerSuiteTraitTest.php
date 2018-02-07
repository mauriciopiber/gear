<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerSuiteTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuiteTrait;

/**
 * @group Gear
 * @group ControllerSuite
 * @group Service
 */
class ControllerSuiteTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use ControllerSuiteTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite');
        $serviceManager->setService('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getControllerSuite();
        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite')->reveal();
        $this->setControllerSuite($mocking);
        $this->assertEquals($mocking, $this->getControllerSuite());
    }
}
