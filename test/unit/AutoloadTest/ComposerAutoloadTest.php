<?php
namespace GearTest\AutoloadTest;

use PHPUnit\Framework\TestCase;
use Gear\Autoload\ComposerAutoload;
use org\bovigo\vfs\vfsStream;
use Zend\Json\Json;

/**
 * @group za
 */
class ComposerAutoloadTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->mockFile = file_get_contents(__DIR__.'/_files/composer.json');

        $this->root = vfsStream::setUp('project');

        file_put_contents(vfsStream::url('project/composer.json'), $this->mockFile);

        $this->autoload = new ComposerAutoload($this->module->reveal());
    }

    public function testAddModuleToProject()
    {
        $this->autoload->setProjectFolder(vfsStream::url('project'));
        $this->module->getModuleName()->willReturn('NewModule')->shouldBeCalled();

        $this->assertTrue($this->autoload->addModuleToProject());


        $file = Json::decode(file_get_contents(vfsStream::url('project/composer.json')), 1);

        $this->assertTrue(is_array($file));

        $this->assertArrayHasKey('autoload', $file);
        $this->assertArrayHasKey('psr-0', $file['autoload'***REMOVED***);
        $this->assertArrayHasKey('NewModule', $file['autoload'***REMOVED***['psr-0'***REMOVED***);
        $this->assertArrayHasKey('NewModuleTest', $file['autoload'***REMOVED***['psr-0'***REMOVED***);

        $this->assertEquals('module/NewModule/src', $file['autoload'***REMOVED***['psr-0'***REMOVED***['NewModule'***REMOVED***);
        $this->assertEquals('module/NewModule/test/unit', $file['autoload'***REMOVED***['psr-0'***REMOVED***['NewModuleTest'***REMOVED***);

        $this->assertEquals(
            file_get_contents(__DIR__.'/_files/add-composer.json'),
            file_get_contents(vfsStream::url('project/composer.json'))
        );
    }

    public function testRemoveModuleFromProject()
    {
        $this->autoload->setProjectFolder(vfsStream::url('project'));
        $this->module->getModuleName()->willReturn('MyModuleCli')->shouldBeCalled();

        $this->assertTrue($this->autoload->removeModuleFromProject());


        $file = Json::decode(file_get_contents(vfsStream::url('project/composer.json')), 1);

        $this->assertArrayHasKey('autoload', $file);
        $this->assertArrayHasKey('psr-0', $file['autoload'***REMOVED***);
        $this->assertArrayNotHasKey('MyModuleCli', $file['autoload'***REMOVED***['psr-0'***REMOVED***);
        $this->assertArrayNotHasKey('MyModuleCliTest', $file['autoload'***REMOVED***['psr-0'***REMOVED***);

        $this->assertEquals(
            file_get_contents(__DIR__.'/_files/del-composer.json'),
            file_get_contents(vfsStream::url('project/composer.json'))
        );
    }
}