<?php
namespace GearTest\ModuleTest\NodeTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Node
 * @group Package
 */
class PackageTraitTest extends TestCase
{
    use \Gear\Module\Node\PackageTrait;

    public function testSet()
    {
        $karma = $this->prophesize(
            'Gear\Module\Node\Package'
        )->reveal();

        $this->setPackage($karma);
        $this->assertEquals($karma, $this->getPackage());
    }
}
