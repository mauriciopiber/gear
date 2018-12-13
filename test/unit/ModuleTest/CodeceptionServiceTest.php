<?php
namespace GearTest\ModuleTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\CodeceptionService;
use org\bovigo\vfs\vfsStream;

/**
 * @group za
 */
class CodeceptionServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setUp('project');

        $this->mockFile = file_get_contents(__DIR__.'/_files/codeception.yml');

        file_put_contents(vfsStream::url('project/codeception.yml'), $this->mockFile);


        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->codeception = new CodeceptionService();
        $this->codeception->setModule($this->module->reveal());

        $this->codeception->setModuleFolder(vfsStream::url('project'));
    }

    public function testAddModuleToProject()
    {
        $this->module->getModuleName()->willReturn('NewModule')->shouldBeCalled();

        $this->assertTrue($this->codeception->addModuleToProject());

        $this->assertEquals(
            file_get_contents(__DIR__.'/_files/add-codeception.yml'),
            file_get_contents(vfsStream::url('project/codeception.yml'))
        );
    }

    public function testRemoveModuleFromProject()
    {
        $this->module->getModuleName()->willReturn('MyModuleCli')->shouldBeCalled();

        $this->assertTrue($this->codeception->removeModuleFromProject());

        $this->assertEquals(
            file_get_contents(__DIR__.'/_files/del-codeception.yml'),
            file_get_contents(vfsStream::url('project/codeception.yml'))
        );
    }
}