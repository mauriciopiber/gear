<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\NpmUpgradeTrait;

/**
 * @group Gear
 * @group NpmUpgrade
 */
class NpmUpgradeTraitTest extends TestCase
{
    use NpmUpgradeTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Upgrade\NpmUpgrade')->reveal();
        $this->setNpmUpgrade($mocking);
        $this->assertEquals($mocking, $this->getNpmUpgrade());
    }
}
