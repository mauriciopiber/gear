<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Mvc
 * @group Trait
 */
class TraitTestServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');


        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        //         $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $dirService = $this->prophesize('GearBase\Util\Dir\DirService');
        //         $this->serviceLocator->get('dirService')->willReturn($dirService->reveal())->shouldBeCalled();

        $fileService = $this->prophesize('GearBase\Util\File\FileService');
        //         $this->serviceLocator->get('fileService')->willReturn($fileService->reveal())->shouldBeCalled();

        $stringService = $this->prophesize('GearBase\Util\String\StringService');
        //         $this->serviceLocator->get('stringService')->willReturn($stringService->reveal())->shouldBeCalled();

        $this->traitTest = new \Gear\Mvc\TraitTestService(
            $module->reveal(),
            $dirService->reveal(),
            $fileService->reveal(),
            $stringService->reveal()
        );
    }

    /**
     * @covers Gear\Mvc\TraitTestService::createTraitTest
     */
    public function testCreateTraitTest()
    {
        $src = new \GearJson\Src\Src([
            'name' => 'MyTraitClass',
            'type' => 'Service'
        ***REMOVED***);

        $this->assertTrue($this->traitTest->createTraitTest($src, vfsStream::url('module')));
    }

    public function testDependency()
    {
        $this->assertInstanceOf('Gear\Module\BasicModuleStructure', $this->traitTest->getModule());
        $this->assertInstanceOf('GearBase\Util\Dir\DirService', $this->traitTest->getDirService());
        $this->assertInstanceOf('GearBase\Util\String\StringService', $this->traitTest->getStringService());
        $this->assertInstanceOf('GearBase\Util\File\FileService', $this->traitTest->getFileService());
    }

}
