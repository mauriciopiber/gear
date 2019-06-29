<?php
namespace GearTest\ModuleTest\DocsTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;
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

    public function setUp() : void
    {
        parent::setUp();

        vfsStream::setup('module');


        $template       = new \Gear\Creator\Template\TemplateService(
            $this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view')
        );

        $fileService    = new \Gear\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->module = $this->prophesize(ModuleStructure::class);

        $this->string = new \Gear\Util\String\StringService();

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/docs';
    }

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
