<?php
namespace GearTest\ProjectTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Project\Upgrade\ProjectUpgradeTrait;

/**
 * @group Gear
 * @group ProjectUpgrade
 * @gruup Upgrade
 */
class ProjectUpgradeTraitTest extends TestCase
{
    use ProjectUpgradeTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Project\Upgrade\ProjectUpgrade')->reveal();
        $this->setProjectUpgrade($mocking);
        $this->assertEquals($mocking, $this->getProjectUpgrade());
    }
}
