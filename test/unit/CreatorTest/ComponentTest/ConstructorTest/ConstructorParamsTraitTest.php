<?php
namespace GearTest\CreatorTest\ComponentTest\ConstructorTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Zend\ServiceManager\ServiceManager;
use Gear\Creator\Component\Constructor\ConstructorParamsTrait;

/**
 * @group Gear
 * @group ConstructorParams
 * @group Service
 */
class ConstructorParamsTraitTest extends TestCase
{

    use ConstructorParamsTrait;

    public function testGet()
    {
        $serviceLocator = $this->getConstructorParams();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize(ConstructorParams::class)->reveal();
        $this->setConstructorParams($mocking);
        $this->assertEquals($mocking, $this->getConstructorParams());
    }
}
