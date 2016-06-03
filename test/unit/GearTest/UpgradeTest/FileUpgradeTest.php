<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\FileUpgradeTrait;

/**
 * @group Service
 */
class FileUpgradeTest extends AbstractTestCase
{
    use FileUpgradeTrait;

    /**
     * @group Gear
     * @group FileUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getFileUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group FileUpgrade
    */
    public function testGet()
    {
        $fileUpgrade = $this->getFileUpgrade();
        $this->assertInstanceOf('Gear\Upgrade\FileUpgrade', $fileUpgrade);
    }

    /**
     * @group Gear
     * @group FileUpgrade
    */
    public function testSet()
    {
        $mockFileUpgrade = $this->getMockSingleClass(
            'Gear\Upgrade\FileUpgrade'
        );
        $this->setFileUpgrade($mockFileUpgrade);
        $this->assertEquals($mockFileUpgrade, $this->getFileUpgrade());
    }
}
