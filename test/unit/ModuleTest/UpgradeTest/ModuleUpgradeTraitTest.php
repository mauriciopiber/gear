<?php
namespace GearTest\ModuleTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Upgrade\ModuleUpgradeTrait;

/**
 * @group Gear
 * @group ModuleUpgrade
 * @group Upgrade
 */
class ModuleUpgradeTraitTest extends TestCase
{
    use ModuleUpgradeTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Module\Upgrade\ModuleUpgrade')->reveal();
        $this->setModuleUpgrade($mocking);
        $this->assertEquals($mocking, $this->getModuleUpgrade());
    }
}
