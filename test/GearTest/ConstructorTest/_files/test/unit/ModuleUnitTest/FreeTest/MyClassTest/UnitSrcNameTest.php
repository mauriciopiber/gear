<?php
namespace ModuleUnitTest\FreeTest\MyClassTest;

use GearBaseTest\AbstractTestCase;
use ModuleUnit\Free\MyClass\UnitSrcNameTrait;

class UnitSrcName extends AbstractTestCase
{
    use UnitSrcNameTrait;

    public function testSetUnitSrcName()
    {
        $mockUnitSrcName = $this->getMockSingleClass('ModuleUnit\Free\MyClass\UnitSrcName');
        $this->setUnitSrcName($mockUnitSrcName);
        $this->assertEquals($mockUnitSrcName, $this->getUnitSrcName);
    }

    public function testGetUnitSrcName()
    {
        $this->assertInstanceOf(
            'ModuleUnit\Free\MyClass\UnitSrcNameTrait',
            $this->getUnitSrcName()
        );
    }
}
