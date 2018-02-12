<?php
namespace GearTest\ProjectTest\ComposerTest;

use PHPUnit\Framework\TestCase;
use Gear\Project\Composer\ComposerServiceTrait;

/**
 * @group Gear
 * @group ComposerService
 */
class ComposerServiceTraitTest extends TestCase
{
    use ComposerServiceTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Project\Composer\ComposerService')->reveal();
        $this->setComposerService($mocking);
        $this->assertEquals($mocking, $this->getComposerService());
    }
}
