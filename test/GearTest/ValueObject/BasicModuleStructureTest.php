<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class BasicModuleStructureTest extends AbstractGearTest
{
    public function testUp()
    {
        $structure = $this->getServiceLocator('moduleStructure');
        $this->assertInstanceOf('Gear\ValueObject\BasicModuleStructure', $structure);
    }
}
