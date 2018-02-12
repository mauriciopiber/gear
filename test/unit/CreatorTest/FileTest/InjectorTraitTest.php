<?php
namespace GearTest\CreatorTest\FileTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\Injector\InjectorTrait;

/**
 * @group Gear
 * @group Injector
 */
class InjectorTraitTest extends TestCase
{
    use InjectorTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Creator\Injector\Injector')->reveal();
        $this->setInjector($mocking);
        $this->assertEquals($mocking, $this->getInjector());
    }
}
