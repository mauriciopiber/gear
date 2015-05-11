<?php
namespace GearTest\ValueObject;

class ModuleTest extends \GearTest\AbstractGearTest
{

    public function testConstructObject()
    {
        $moduleObject = new \Gear\ValueObject\Module('meuModule');
        $this->assertInstanceOf('Gear\ValueObject\Module', $moduleObject);
    }

    public function testPrepareFolders()
    {
        $moduleObject = new \Gear\ValueObject\Module('MeuModule');
        $moduleObject->getStructure()->prepare();
        $this->assertEquals(\Gear\Service\ProjectService::getProjectFolder().'/module/MeuModule',$moduleObject->getStructure()->getMainFolder());
    }
}
