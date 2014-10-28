<?php
namespace GearTest\ValueObject;

class ModuleTest extends \GearTest\AbstractGearTest
{
    const MAIN = '/var/www/html/modules/module/';

    public function testConstructObject()
    {
        $moduleObject = new \Gear\ValueObject\Module('meuModule');
        $this->assertInstanceOf('Gear\ValueObject\Module', $moduleObject);
    }

    public function testPrepareFolders()
    {
        $moduleObject = new \Gear\ValueObject\Module('MeuModule');
        $moduleObject->getStructure()->prepare();
        $this->assertEquals(self::MAIN.'MeuModule',$moduleObject->getStructure()->getMainFolder());
    }
}
