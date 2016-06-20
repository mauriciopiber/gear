<?php
namespace GearTest\ModuleTest\ConfigTest;

use GearBaseTest\AbstractTestCase;
use Gear\Module\Config\ApplicationConfigTrait;

/**
 * @group Gear
 * @group ApplicationConfig
 */
class ApplicationConfigTraitTest extends AbstractTestCase
{
    use ApplicationConfigTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getApplicationConfig();
        $this->assertInstanceOf('Gear\Module\Config\ApplicationConfig', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Module\Config\ApplicationConfig')->reveal();
        $this->setApplicationConfig($mocking);
        $this->assertEquals($mocking, $this->getApplicationConfig());
    }
}
