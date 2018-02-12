<?php
namespace GearTest\ProjectTest\ComposerTest;

use PHPUnit\Framework\TestCase;
use Gear\Project\Composer\ComposerServiceTrait;
use org\bovigo\vfs\vfsStream;
use GearTest\UtilTestTrait;

/**
 * @group ComposerService
 * @group Service
 */
class ComposerServiceTest extends TestCase
{
    use UtilTestTrait;

    use ComposerServiceTrait;

    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('project');

        $this->scriptService = $this->prophesize('Gear\Script\ScriptService');


        $template       = new \Gear\Creator\Template\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');
        $this->composerEdge = $this->prophesize('Gear\Edge\ComposerEdge');
        $this->array = new \Gear\Util\Vector\ArrayService();
    }

    public function testDependency()
    {
        $this->fileCreator = $this->prophesize('Gear\Creator\File');

        $this->composerService = new \Gear\Project\Composer\ComposerService(
            $this->fileCreator->reveal(),
            $this->stringService->reveal(),
            $this->scriptService->reveal(),
            $this->composerEdge->reveal(),
            $this->array
        );

        $this->assertEquals($this->composerService->getScriptService(), $this->scriptService->reveal());
        $this->assertEquals($this->composerService->getFileCreator(), $this->fileCreator->reveal());
        $this->assertEquals($this->composerService->getStringService(), $this->stringService->reveal());
        $this->assertEquals($this->composerService->getComposerEdge(), $this->composerEdge->reveal());
        $this->assertEquals($this->composerService->getArrayService(), $this->array);
    }

    public function testCreateComposer()
    {
        $this->file = vfsStream::url('project/composer.json');


        $this->composerEdge->getComposerProject('web')->willReturn(
            [
                'require' => [
                    'mpiber/package-1' => '1.0.0',
                    'mpiber/package-2' => '2.0.0',
                    'mpiber/package-3' => '3.0.0',
                ***REMOVED***,
                'require-dev' => [
                    'mpiber/unit-1' => '^1.0.0',
                    'mpiber/unit-2' => '*2.0.0'
                ***REMOVED***

            ***REMOVED***
        );

        $this->stringService->str('url', 'MyProject')->willReturn('my-project')->shouldBeCalled();

        $this->composerService = new \Gear\Project\Composer\ComposerService(
            $this->fileCreator,
            $this->stringService->reveal(),
            $this->scriptService->reveal(),
            $this->composerEdge->reveal(),
            $this->array
        );

        $project = $this->prophesize('Gear\Project\Project');
        $project->getType()->willReturn('web')->shouldBeCalled();
        $project->getProject()->willReturn('MyProject')->shouldBeCalled();
        $project->getProjectLocation()->willReturn(vfsStream::url('project'))->shouldBeCalled();

        $created = $this->composerService->createComposer($project->reveal());

        $this->assertFileExists($created);

        $this->assertStringEndsWith('composer.json', $created);


        $expected = <<<EOS
{
    "name" : "mauriciopiber/my-project",
    "require" : {
        "mpiber/package-1": "1.0.0",
        "mpiber/package-2": "2.0.0",
        "mpiber/package-3": "3.0.0"
    },
    "require-dev" : {
        "mpiber/unit-1": "^1.0.0",
        "mpiber/unit-2": "*2.0.0"
    },
    "repositories" : [
        {
            "type" : "composer",
            "url" : "https://mirror.pibernetwork.com"
        },
        { "packagist" : false }
    ***REMOVED***
}
EOS;

        $file = file_get_contents($this->file);

        $this->assertEquals($expected, $file);
    }

    public function testRunComposerUpdateOnAnotherProject()
    {
        $cmd = \GearBase\Module::getProjectFolder().'/bin/installer-utils/composer-update vfs://project';
        $this->scriptService->setLocation(vfsStream::url('project'))->willReturn(true)->shouldBeCalled();
        $this->scriptService->run($cmd)->willReturn(true)->shouldBeCalled();

        //$this->scriptService->run()->shouldBeCalled();

        $this->composerService = new \Gear\Project\Composer\ComposerService(
            $this->fileCreator,
            $this->stringService->reveal(),
            $this->scriptService->reveal(),
            $this->composerEdge->reveal(),
            $this->array
        );

        $project = $this->prophesize('Gear\Project\Project');
        //$project->getType()->willReturn('web')->shouldBeCalled();
        //$project->getProject()->willReturn('MyProject')->shouldBeCalled();
        $project->getProjectLocation()->willReturn(vfsStream::url('project'))->shouldBeCalled();

        $this->assertTrue($this->composerService->runComposerUpdate($project->reveal()));

    }


}
