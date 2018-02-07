<?php
namespace GearTest\CreatorTest\FileTest;

use GearBaseTest\AbstractTestCase;
use Gear\Creator\Injector\InjectorTrait;

/**
 * @group Gear
 * @group Injector
 */
class InjectorTraitTest extends AbstractTestCase
{
    use InjectorTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getInjector();
        $this->assertInstanceOf('Gear\Creator\Injector\Injector', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Creator\Injector\Injector')->reveal();
        $this->setInjector($mocking);
        $this->assertEquals($mocking, $this->getInjector());
    }
}
