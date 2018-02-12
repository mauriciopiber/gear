<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\ComposerUpgradeTrait;

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
        $mocking = $this->prophesize('Gear\Upgrade\ComposerUpgrade')->reveal();
        $this->setComposerUpgrade($mocking);
        $this->assertEquals($mocking, $this->getComposerUpgrade());
    }
}
