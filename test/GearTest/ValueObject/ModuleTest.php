<?php
namespace GearTest\ValueObject;

class ModuleTest extends \GearTest\AbstractGearTest
{
    public function testConstructObject()
    {
        $moduleObject = new \Gear\ValueObject\Mvc\Module();
        $this->assertInstanceOf('Gear\ValueObject\Mvc\Module', $moduleObject);
    }
}