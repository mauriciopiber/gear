<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\FileUpgradeTrait;

/**
 * @group Gear
 * @group FileUpgrade
 */
class FileUpgradeTraitTest extends TestCase
{
    use FileUpgradeTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Upgrade\FileUpgrade')->reveal();
        $this->setFileUpgrade($mocking);
        $this->assertEquals($mocking, $this->getFileUpgrade());
    }
}
