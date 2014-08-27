<?php
use Gear\Model\ModelGear;

class ModelGearTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }


    public function testCreateSucessful()
    {
    	$file = new ModelGear();
    	$createFile = $file->create();
    	$this->assertTrue($createFile);
    }

    public function testCreateModuleControlller()
    {
        $file = new ModelGear();
        $createFile = $file->createModuleModel(array());
        $this->assertTrue($createFile);
    }

}