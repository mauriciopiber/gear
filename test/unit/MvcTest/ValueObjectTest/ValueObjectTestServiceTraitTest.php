<?php
namespace GearTest\MvcTest\ValueObjectTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Mvc\ValueObject\ValueObjectTestServiceTrait;

/**
 * @group Gear
 * @group ValueObjectTestService
 * @group Service
 */
class ValueObjectTestServiceTraitTest extends TestCase
{

    use ValueObjectTestServiceTrait;

    public function testGet()
    {
        $serviceLocator = $this->getValueObjectTestService();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\ValueObject\ValueObjectTestService')->reveal();
        $this->setValueObjectTestService($mocking);
        $this->assertEquals($mocking, $this->getValueObjectTestService());
    }
}
