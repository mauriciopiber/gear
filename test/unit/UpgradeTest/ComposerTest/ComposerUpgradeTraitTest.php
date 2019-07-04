<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\Composer\ComposerUpgrade;
use Gear\Upgrade\Composer\ComposerUpgradeTrait;

/**
 * @group Upgrade
 * @group Gear
 * @group ComposerUpgrade
 */
class ComposerUpgradeTraitTest extends TestCase
{
    use ComposerUpgradeTrait;

    public function testSet()
    {
        $mocking = $this->prophesize(ComposerUpgrade::class)->reveal();
        $this->setComposerUpgrade($mocking);
        $this->assertEquals($mocking, $this->getComposerUpgrade());
    }
}
