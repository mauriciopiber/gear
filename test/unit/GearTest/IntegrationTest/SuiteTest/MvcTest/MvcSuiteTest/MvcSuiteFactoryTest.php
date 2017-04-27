<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest\MvcSuiteTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuiteFactory;

/**
 * @group Gear
 * @group MvcSuite
 * @group Service
 */
class MvcSuiteFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator')
            ->willReturn($this->prophesize('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile')->reveal())
            ->shouldBeCalled();

        $factory = new MvcSuiteFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite', $instance);
    }
}
