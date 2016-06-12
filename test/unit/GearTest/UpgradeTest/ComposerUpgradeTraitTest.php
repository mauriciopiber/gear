<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\ComposerUpgradeTrait;

/**
 * @group Upgrade
 * @group Gear
 * @group ComposerUpgrade
 */
class ComposerUpgradeTraitTest extends AbstractTestCase
{
    use ComposerUpgradeTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getComposerUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Upgrade\ComposerUpgrade')->reveal();
        $this->setComposerUpgrade($mocking);
        $this->assertEquals($mocking, $this->getComposerUpgrade());
    }
}
