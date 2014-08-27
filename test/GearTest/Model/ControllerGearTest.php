<?php
use Gear\Model\ControllerGear;

class ControllerGearTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }


    public function testCreateSucessful()
    {
    	$file = new ControllerGear();
    	$createFile = $file->create();
    	$this->assertTrue($createFile);
    }

    public function testCreateModuleControlller()
    {
        $file = new ControllerGear();
        $createFile = $file->createModuleController(array());
        $this->assertTrue($createFile);
    }

}