<?php
use Gear\Model\ModuleGear;

class ModuleGearTest extends PHPUnit_Framework_TestCase
{
    public function testInitModule()
    {
        $codeGear = new ModuleGear();
        $response = $codeGear->initModule('Teste');
        $this->assertEquals($response,true);
    }

    public function testClearModule()
    {
        $codeGear = new ModuleGear();
        $response = $codeGear->clearModule('Teste');
        $this->assertEquals($response,true);
    }

    public function testRegisterModule()
    {
        $codeGear = new ModuleGear('piberthebest','/var/www/html/');
        $codeGear->registerModule('Blog');


    }
}