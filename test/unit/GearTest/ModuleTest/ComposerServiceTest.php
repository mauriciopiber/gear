<?php
namespace GearTest\ModuleTest;

use PHPUnit_Framework_TestCase as TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Module\ComposerService;
use Gear\Creator\Template\TemplateService;
use GearBase\Util\File\FileService;
use Gear\Creator\FileCreator\FileCreator;
use GearBase\Util\String\StringService;
use Gear\Util\Vector\ArrayService;
use GearTest\UtilTestTrait;

/**
 * @group Module
 * @group ModuleConstruct
 * @group Create
 */
class ComposerServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();

        //FileCreator


        $template       = new TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new FileService();
        $fileCreator    = new FileCreator($fileService, $template);

        $stringService  = new StringService();
        $arrayService   = new ArrayService();

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->edge = $this->prophesize('Gear\Edge\ComposerEdge');

        $this->composer = new ComposerService(
            $this->module->reveal(),
            $this->edge->reveal(),
            $fileCreator,
            $arrayService,
            $stringService
        );
    }



    public function testCreateComposer()
    {
        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');

        $this->module->getModuleName()->willReturn('Gearing');
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $this->edge->getComposerModule('web')->willReturn(
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

        $created = $this->composer->createComposerAsProject();

        $this->assertStringEndsWith('composer.json', $created);


        $expected = <<<EOS
{
    "name" : "mauriciopiber/gearing",
    "require" : {
        "mpiber/package-1": "1.0.0",
        "mpiber/package-2": "2.0.0",
        "mpiber/package-3": "3.0.0"
    },
    "require-dev" : {
        "mpiber/unit-1": "^1.0.0",
        "mpiber/unit-2": "*2.0.0"
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