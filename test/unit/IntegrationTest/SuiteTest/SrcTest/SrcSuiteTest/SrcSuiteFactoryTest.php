<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcSuiteTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuiteFactory;

/**
 * @group Gear
 * @group SrcSuite
 * @group Service
 */
class SrcSuiteFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator')
            ->willReturn($this->prophesize('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator')->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
            ->willReturn($this->prophesize('Gear\Integration\Component\SuperTestFile\SuperTestFile')->reveal())
            ->shouldBeCalled();

        $factory = new SrcSuiteFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Integration\Suite\Src\SrcSuite\SrcSuite', $instance);
    }
}
