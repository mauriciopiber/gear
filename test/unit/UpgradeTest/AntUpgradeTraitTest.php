<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\AntUpgradeTrait;

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
        $mocking = $this->prophesize('Gear\Upgrade\AntUpgrade')->reveal();
        $this->setAntUpgrade($mocking);
        $this->assertEquals($mocking, $this->getAntUpgrade());
    }
}
