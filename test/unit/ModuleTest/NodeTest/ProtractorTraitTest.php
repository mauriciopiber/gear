<?php
namespace GearTest\ModuleTest\NodeTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Node
 * @group Protractor
 */
class ProtractorTraitTest extends TestCase
{
    use \Gear\Module\Node\ProtractorTrait;

    public function testSet()
    {
        $karma = $this->prophesize(
            'Gear\Module\Node\Protractor'
        )->reveal();

        $this->setProtractor($karma);
        $this->assertEquals($karma, $this->getProtractor());
    }
}
