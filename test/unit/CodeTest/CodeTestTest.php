<?php
namespace GearTest\CodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Schema\Src\Src;
use Gear\Module\Structure\ModuleStructure;
use Gear\Code\CodeTest;
use Gear\Util\String\StringService;
use Gear\Util\Dir\DirService;
use Gear\Util\Vector\ArrayService;

/**
 * @group Creator
 */
class CreateTestTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();

        $this->module = $this->prophesize(ModuleStructure::class);


        $this->string = new StringService();

        $this->codeTest = new CodeTest(
            $this->module->reveal(),
            $this->string,
            new DirService(),
            new ArrayService()
            //new ConstructorParams($this->string)
        );


        $this->module->getModuleName()->willReturn('GearIt');

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


    // /**
    //  * @dataProvider getFullClassNameFixture
    //  */
    // public function testGetFullClassName($name, $type, $namespace, $expected)
    // {
    //     $src = $this->prophesize(Src::class);
    //     $src->getName()->willReturn($name);
    //     $src->getType()->willReturn($type);
    //     $src->getNamespace()->willReturn($namespace);

    //     $this->assertEquals($expected, $this->codeTest->getFullClassName($src->reveal()));
    // }

    /**
     * @dataProvider getNamespaceFixture
     */
    public function testGetNamespace($name, $type, $namespace, $expected)
    {
        $src = $this->prophesize(Src::class);
        $src->getName()->willReturn($name);
        $src->getType()->willReturn($type);
        $src->getNamespace()->willReturn($namespace);

        $this->assertEquals($expected, $this->codeTest->getNamespace($src->reveal()));
    }
}
