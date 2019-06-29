<?php
namespace GearTest\CreatorTest\FileTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\Injector\Injector;
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
        $mocking = $this->prophesize(Injector::class)->reveal();
        $this->setInjector($mocking);
        $this->assertEquals($mocking, $this->getInjector());
    }
}
