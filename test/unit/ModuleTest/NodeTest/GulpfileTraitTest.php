<?php
namespace GearTest\ModuleTest\NodeTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Node
 * @group Gulpfile
 */
class GulpfileTraitTest extends TestCase
{
    use \Gear\Module\Node\GulpfileTrait;

    public function testSet()
    {
        $karma = $this->prophesize(
            'Gear\Module\Node\Gulpfile'
        )->reveal();

        $this->setGulpfile($karma);
        $this->assertEquals($karma, $this->getGulpfile());
    }
}
