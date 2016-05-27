<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\ComposerUpgradeTrait;

/**
 * @group Service
 */
class ComposerUpgradeTest extends AbstractTestCase
{
    use ComposerUpgradeTrait;

    /**
     * @group Gear
     * @group ComposerUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getComposerUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ComposerUpgrade
    */
    public function testGet()
    {
        $composerUpgrade = $this->getComposerUpgrade();
        $this->assertInstanceOf('Gear\Upgrade\ComposerUpgrade', $composerUpgrade);
    }

    /**
     * @group Gear
     * @group ComposerUpgrade
    */
    public function testSet()
    {
        $mockComposerUpgrade = $this->getMockSingleClass(
            'Gear\Upgrade\ComposerUpgrade'
        );
        $this->setComposerUpgrade($mockComposerUpgrade);
        $this->assertEquals($mockComposerUpgrade, $this->getComposerUpgrade());
    }
}
