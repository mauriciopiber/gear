<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\Dir\DirUpgradeTrait;

/**
 * @group Gear
 * @group DirUpgrade
 */
class DirUpgradeTraitTest extends TestCase
{
    use DirUpgradeTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Upgrade\Dir\DirUpgrade')->reveal();
        $this->setDirUpgrade($mocking);
        $this->assertEquals($mocking, $this->getDirUpgrade());
    }
}
