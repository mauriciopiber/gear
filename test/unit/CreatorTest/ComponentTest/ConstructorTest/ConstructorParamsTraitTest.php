<?php
namespace GearTest\CreatorTest\ComponentTest\ConstructorTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Creator\Component\Constructor\ConstructorParamsTrait;

/**
 * @group Gear
 * @group ConstructorParams
 * @group Service
 */
class ConstructorParamsTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use ConstructorParamsTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Creator\Component\Constructor\ConstructorParams');
        $serviceManager->setService('Gear\Creator\Component\Constructor\ConstructorParams', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getConstructorParams();
        $this->assertInstanceOf('Gear\Creator\Component\Constructor\ConstructorParams', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Creator\Component\Constructor\ConstructorParams')->reveal();
        $this->setConstructorParams($mocking);
        $this->assertEquals($mocking, $this->getConstructorParams());
    }
}
