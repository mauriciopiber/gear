<?php
use Gear\Model\ConfigGear;

class AppGearTest extends PHPUnit_Framework_TestCase
{
    public function testConfigSucessfull()
    {
        $appGear = new ConfigGear();
        $response = $appGear->setConfig();
        $this->assertEquals($response,true);
    }
}
