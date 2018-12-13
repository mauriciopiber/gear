<?php
namespace GearTest\AutoloadTest;

use PHPUnit\Framework\TestCase;
use Gear\Autoload\ComposerAutoloadTrait;

/**
 * @group Gear
 * @group ComposerAutoload
 */
class ComposerAutoloadTraitTest extends TestCase
{
    use ComposerAutoloadTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Autoload\ComposerAutoload')->reveal();
        $this->setComposerAutoload($mocking);
        $this->assertEquals($mocking, $this->getComposerAutoload());
    }
}
