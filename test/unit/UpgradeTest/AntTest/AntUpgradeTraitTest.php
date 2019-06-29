<?php
namespace GearTest\UpgradeTest\AntTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\Ant\AntUpgrade;
use Gear\Upgrade\Ant\AntUpgradeTrait;

/**
 * @group Upgrade
 * @group Gear
 * @group AntUpgrade
 */
class AntUpgradeTraitTest extends TestCase
{
    use AntUpgradeTrait;

    public function testSet()
    {
        $mocking = $this->prophesize(AntUpgrade::class)->reveal();
        $this->setAntUpgrade($mocking);
        $this->assertEquals($mocking, $this->getAntUpgrade());
    }
}
