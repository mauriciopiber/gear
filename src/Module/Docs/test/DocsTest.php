<?php
namespace GearTest\ModuleTest\DocsTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\UtilTestTrait;

/**
 * @group Service
 * @group Docs
 */
class DocsTest extends TestCase
{
    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $template = new \Gear\Creator\Template\TemplateService(
            $this->createTemplate('docs-template', __DIR__.'/..')
        );

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->string = new \GearBase\Util\String\StringService();

        $this->template = __DIR__.'/expected';
    }
    /**
     * @group x1
     */
    public function testCreateIndexDocs()
    {
        vfsStream::newDirectory('docs')->at(vfsStreamWrapper::getRoot());

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getDocsFolder()->willReturn(vfsStream::url('module/docs'))->shouldBeCalled();

        $this->docs = new \Gear\Module\Docs\Docs(
            $this->module->reveal(),
            $this->string,
            $this->fileCreator
        );

        $result = $this->docs->createIndex();

        $expected = $this->template.'/index-web.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($result)
        );
    }

    public function testCreateConfig()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->docs = new \Gear\Module\Docs\Docs(
            $this->module->reveal(),
            $this->string,
            $this->fileCreator
        );

        $result = $this->docs->createConfig();

        $expected = $this->template.'/mkdocs.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($result)
        );
    }

    public function testCreateReadme()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->docs = new \Gear\Module\Docs\Docs(
            $this->module->reveal(),
            $this->string,
            $this->fileCreator
        );

        $result = $this->docs->createReadme();

        $expected = $this->template.'/readme.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($result)
        );
    }
}
