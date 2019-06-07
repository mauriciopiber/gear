<?php
namespace GearTest\ProjectTest\DocsTest;

use PHPUnit\Framework\TestCase;
use Gear\Project\Docs\DocsTrait;
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
    use DocsTrait;

    public function setUp() : void
    {
        parent::setUp();

        vfsStream::setup('project');


        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));

        $fileService    = new \Gear\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'MyProject'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $this->string = new \Gear\Util\String\StringService();

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/project';
    }

    public function testCreateIndexDocs()
    {
        vfsStream::newDirectory('docs')->at(vfsStreamWrapper::getRoot());

        $this->docs = new \Gear\Project\Docs\Docs(
            $this->config,
            $this->string,
            $this->fileCreator
        );

        $this->docs->setProject(vfsStream::url('project'));

        $result = $this->docs->createIndex();

        $expected = $this->template.'/docs/index.md.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($result)
        );
    }

    public function testCreateConfig()
    {
        $this->docs = new \Gear\Project\Docs\Docs(
            $this->config,
            $this->string,
            $this->fileCreator
        );

        $this->docs->setProject(vfsStream::url('project'));

        $result = $this->docs->createConfig();

        $expected = $this->template.'/mkdocs.yml.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($result)
        );
    }

    public function testCreateReadme()
    {
        $this->docs = new \Gear\Project\Docs\Docs(
            $this->config,
            $this->string,
            $this->fileCreator
        );

        $this->docs->setProject(vfsStream::url('project'));

        $result = $this->docs->createReadme();

        $expected = $this->template.'/README.md.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($result)
        );
    }
}
