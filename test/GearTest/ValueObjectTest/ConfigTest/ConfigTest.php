<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class ConfigTest extends AbstractGearTest
{
    const BASE = '/var/www/html/modules';

    public function testCreateConfig()
    {
        $config = new \Gear\ValueObject\Config\Config('Module');
        $this->assertEquals('Module', $config->getModule());
        $this->assertEquals(self::BASE, $config->getLocal());
        $this->assertEquals(false, $config->exist());
    }

    public function testExistGear()
    {
        $config = new \Gear\ValueObject\Config\Config('Gear');
        $this->assertEquals('Gear', $config->getModule());
        $this->assertEquals(self::BASE, $config->getLocal());
        $this->assertEquals(true, $config->exist());
    }
}
