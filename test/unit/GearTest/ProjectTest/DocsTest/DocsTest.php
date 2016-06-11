<?php
namespace GearTest\ProjectTest\DocsTest;

use GearBaseTest\AbstractTestCase;
use Gear\Project\Docs\DocsTrait;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * @group Service
 * @group Docs
 */
class DocsTest extends AbstractTestCase
{
    use DocsTrait;

    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('project');


        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'MyProject'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $this->string = new \GearBase\Util\String\StringService();

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/project/docs';
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

        $expected = $this->template.'/index.phtml';

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

        $expected = $this->template.'/mkdocs.phtml';

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

        $expected = $this->template.'/readme.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($result)
        );
    }
}
