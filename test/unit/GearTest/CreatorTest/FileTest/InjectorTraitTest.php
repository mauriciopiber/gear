<?php
namespace GearTest\CreatorTest\FileTest;

use GearBaseTest\AbstractTestCase;
use Gear\Creator\File\InjectorTrait;

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
        $this->assertInstanceOf('Gear\Creator\File\Injector', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Creator\File\Injector')->reveal();
        $this->setInjector($mocking);
        $this->assertEquals($mocking, $this->getInjector());
    }
}
