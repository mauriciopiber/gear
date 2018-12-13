<?php
namespace GearTest\ModuleTest\NodeTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Node
 * @group Karma
 */
class KarmaTraitTest extends TestCase
{
    use \Gear\Module\Node\KarmaTrait;

    public function testSet()
    {
        $karma = $this->prophesize(
            'Gear\Module\Node\Karma'
        )->reveal();

        $this->setKarma($karma);
        $this->assertEquals($karma, $this->getKarma());
    }
}
