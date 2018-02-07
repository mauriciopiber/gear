<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\AntUpgradeTrait;

/**
 * @group Upgrade
 * @group Gear
 * @group AntUpgrade
 */
class AntUpgradeTraitTest extends AbstractTestCase
{
    use AntUpgradeTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getAntUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Upgrade\AntUpgrade')->reveal();
        $this->setAntUpgrade($mocking);
        $this->assertEquals($mocking, $this->getAntUpgrade());
    }
}
