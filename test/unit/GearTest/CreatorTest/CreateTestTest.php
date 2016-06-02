<?php
namespace GearTest\CreatorTest\FileCreatorTest\AppTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Creator
 */
class CreateTestTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->codeTest = new \Gear\Creator\CodeTest();

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getModuleName()->willReturn('GearIt');

        $this->codeTest->setModule($module->reveal());
    }


    public function getNamespaceFixture()
    {
        return [
            ['MyFile', 'Service', null, 'ServiceTest'***REMOVED***,
            ['MyFile', 'Service', 'Creator\Fixture', 'CreatorTest\FixtureTest'***REMOVED***
        ***REMOVED***;
    }

    public function getFullClassNameFixture()
    {
        return [
            ['MyFile', 'Service', null, 'GearIt\Service\MyFile'***REMOVED***,
            ['MyFile', 'Service', 'Creator\Fixture', 'GearIt\Creator\Fixture\MyFile'***REMOVED***
        ***REMOVED***;
    }


    /**
     * @dataProvider getFullClassNameFixture
     */
    public function testGetFullClassName($name, $type, $namespace, $expected)
    {
        $src = $this->prophesize('GearJson\Src\Src');
        $src->getName()->willReturn($name);
        $src->getType()->willReturn($type);
        $src->getNamespace()->willReturn($namespace);

        $this->assertEquals($expected, $this->codeTest->getFullClassName($src->reveal()));
    }

    /**
     * @dataProvider getNamespaceFixture
     */
    public function testGetNamespace($name, $type, $namespace, $expected)
    {
        $src = $this->prophesize('GearJson\Src\Src');
        $src->getName()->willReturn($name);
        $src->getType()->willReturn($type);
        $src->getNamespace()->willReturn($namespace);

        $this->assertEquals($expected, $this->codeTest->getNamespace($src->reveal()));
    }
}
