<?php
namespace GearTest\UpgradeTest\AntTest;

use PHPUnit\Framework\TestCase;
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
        $mocking = $this->prophesize('Gear\Upgrade\Ant\AntUpgrade')->reveal();
        $this->setAntUpgrade($mocking);
        $this->assertEquals($mocking, $this->getAntUpgrade());
    }
}
