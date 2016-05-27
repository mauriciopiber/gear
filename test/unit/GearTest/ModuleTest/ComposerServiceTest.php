<?php
namespace GearTest\ModuleTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Module
 * @group ModuleConstruct
 * @group Create
 */
class ComposerServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        //FileCreator
        $this->composer = new \Gear\Module\ComposerService();

        $phpRenderer = $this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view');

        $template = new \Gear\Creator\TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService = new \GearBase\Util\File\FileService();
        $stringService = new \GearBase\Util\String\StringService();

        $fileCreator = new \Gear\Creator\File($fileService, $template);

        $arrayService = new \Gear\Util\Vector\ArrayService();

        $this->composer->setArrayService($arrayService);
        $this->composer->setFileCreator($fileCreator);
        $this->composer->setStringService($stringService);
    }



    public function testCreateComposer()
    {
        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getModuleName()->willReturn('Gearing');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));


        $yaml = $this->prophesize('Gear\Edge\ComposerEdge');
        $yaml->getComposerModule('web')->willReturn(
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

        $this->composer->setComposerEdge($yaml->reveal());

        $this->composer->setModule($module->reveal());

        $created = $this->composer->createComposerAsProject();

        $this->assertStringEndsWith('composer.json', $created);


        $expected = <<<EOS
{
    "name" : "mauriciopiber/gearing",
    "require" : {
        'mpiber/package-1': '1.0.0',
        'mpiber/package-2': '2.0.0',
        'mpiber/package-3': '3.0.0'
    },
    "require-dev" : {
        'mpiber/unit-1': '^1.0.0',
        'mpiber/unit-2': '*2.0.0'
    },
    "autoload" : {
        "psr-0" : {
            "Gearing" : "src",
            "GearingTest" : "test/unit"
        }
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
}