<?php
namespace GearTest\MvcTest\ValueObjectTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\ValueObject\ValueObjectTestService;
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
        $mocking = $this->prophesize(ValueObjectTestService::class)->reveal();
        $this->setValueObjectTestService($mocking);
        $this->assertEquals($mocking, $this->getValueObjectTestService());
    }
}
