<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerTest\ControllerSuiteTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuiteFactory;

/**
 * @group Gear
 * @group ControllerSuite
 * @group Service
 */
class ControllerSuiteFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator')
            ->willReturn($this->prophesize('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile')->reveal())
            ->shouldBeCalled();

        $factory = new ControllerSuiteFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite', $instance);
    }
}
