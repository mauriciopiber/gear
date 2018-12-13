<?php
namespace GearTest\MvcTest\ValueObjectTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Mvc\ValueObject\ValueObjectTestServiceTrait;

/**
 * @group Gear
 * @group ValueObjectTestService
 * @group Service
 */
class ValueObjectTestServiceTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use ValueObjectTestServiceTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Mvc\ValueObject\ValueObjectTestService');
        $serviceManager->setService('Gear\Mvc\ValueObject\ValueObjectTestService', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getValueObjectTestService();
        $this->assertInstanceOf('Gear\Mvc\ValueObject\ValueObjectTestService', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\ValueObject\ValueObjectTestService')->reveal();
        $this->setValueObjectTestService($mocking);
        $this->assertEquals($mocking, $this->getValueObjectTestService());
    }
}
