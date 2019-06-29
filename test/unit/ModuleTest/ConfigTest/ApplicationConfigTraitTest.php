<?php
namespace GearTest\ModuleTest\ConfigTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Config\ApplicationConfig;
use Gear\Module\Config\ApplicationConfigTrait;

/**
 * @group Gear
 * @group ApplicationConfig
 */
class ApplicationConfigTraitTest extends TestCase
{
    use ApplicationConfigTrait;

    public function testSet()
    {
        $mocking = $this->prophesize(ApplicationConfig::class)->reveal();
        $this->setApplicationConfig($mocking);
        $this->assertEquals($mocking, $this->getApplicationConfig());
    }
}
