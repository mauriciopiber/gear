<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\Dir\DirUpgrade;
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
        $mocking = $this->prophesize(DirUpgrade::class)->reveal();
        $this->setDirUpgrade($mocking);
        $this->assertEquals($mocking, $this->getDirUpgrade());
    }
}
