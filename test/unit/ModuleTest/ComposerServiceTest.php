<?php
namespace GearTest\ModuleTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Module\ComposerService;
use Gear\Creator\Template\TemplateService;
use Gear\Util\File\FileService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\String\StringService;
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

    public function setUp() : void
    {
        parent::setUp();

        $fileCreator    = $this->createFileCreator();

        $stringService  = new StringService();
        $arrayService   = new ArrayService();

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->edge = $this->prophesize('Gear\Edge\Composer\ComposerEdge');

        $this->composer = new ComposerService(
            $this->module->reveal(),
            $this->edge->reveal(),
            $fileCreator,
            $arrayService,
            $stringService
        );
    }

    public function configOneLevel()
    {
        return [
            ['Gear\Gearing'***REMOVED***,
            ['Gear\\Gearing'***REMOVED***,
            ['Gear\\\Gearing'***REMOVED***,
            ['Gear\\\\\Gearing'***REMOVED***,
        ***REMOVED***;
    }

    public function configTwoLevel()
    {
        return [
            ['Gear\Gearing\MyOther'***REMOVED***,
            ['Gear\\Gearing\\MyOther'***REMOVED***,
            ['Gear\\\Gearing\\\MyOther'***REMOVED***,
            ['Gear\\\\\Gearing\\\\MyOther'***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider configOneLevel
     * @group x1
     */
    public function testCreateComposerOneLeveLNamespace($name)
    {
        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');

        $this->module->getModuleName()->willReturn($name);
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getNamespace()->willReturn($name);

        $this->module->normalizeQuotes($name, 2)->willReturn('Gear\\\\Gearing');

        $this->edge->getComposerModule('web')->willReturn(
            [
                'require' => [
                    'mpiber/package-3' => '3.0.0',
                ***REMOVED***,
                'require-dev' => [
                    'mpiber/unit-2' => '*2.0.0'
                ***REMOVED***

            ***REMOVED***
        );

        $created = $this->composer->createComposerAsProject();

        $this->assertStringEndsWith('composer.json', $created);


        $expected = <<<EOS
{
    "name" : "mauriciopiber/gear-gearing",
    "require" : {
        "mpiber/package-3": "3.0.0"
    },
    "require-dev" : {
        "mpiber/unit-2": "*2.0.0"
    },
    "autoload" : {
        "psr-4" : {
            "Gear\\\\Gearing\\\\" : "src"
        }
    },
    "autoload-dev" : {
        "psr-4" : {
            "Gear\\\\Gearing\\\\Test\\\\" : "test/unit"
        }
    },
    "config": {
        "secure-http": false
    },
    "repositories" : [
        {
            "type" : "composer",
            "url" : "http://satis"
        },
        { "packagist" : false }
    ***REMOVED***
}
EOS;

        $file = file_get_contents($this->file);

        $this->assertEquals($expected, $file);

    }

    /**
     * @group x2
     * @dataProvider configTwoLevel
     */
    public function testCreateComposerTwoLevel($name)
    {
        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');

        $this->module->getModuleName()->willReturn($name);
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getNamespace()->willReturn($name);

        $this->module->normalizeQuotes($name, 2)->willReturn('Gear\\\\Gearing\\\\MyOther');

        $this->edge->getComposerModule('web')->willReturn(
            [
                'require' => [
                    'mpiber/package-3' => '3.0.0',
                ***REMOVED***,
                'require-dev' => [
                    'mpiber/unit-2' => '*2.0.0'
                ***REMOVED***

            ***REMOVED***
        );

        $created = $this->composer->createComposerAsProject();

        $this->assertStringEndsWith('composer.json', $created);


        $expected = <<<EOS
{
    "name" : "mauriciopiber/gear-gearing-my-other",
    "require" : {
        "mpiber/package-3": "3.0.0"
    },
    "require-dev" : {
        "mpiber/unit-2": "*2.0.0"
    },
    "autoload" : {
        "psr-4" : {
            "Gear\\\\Gearing\\\\MyOther\\\\" : "src"
        }
    },
    "autoload-dev" : {
        "psr-4" : {
            "Gear\\\\Gearing\\\\MyOther\\\\Test\\\\" : "test/unit"
        }
    },
    "config": {
        "secure-http": false
    },
    "repositories" : [
        {
            "type" : "composer",
            "url" : "http://satis"
        },
        { "packagist" : false }
    ***REMOVED***
}
EOS;

        $file = file_get_contents($this->file);

        $this->assertEquals($expected, $file);

    }


    public function testCreateComposer()
    {
        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');

        $this->module->getModuleName()->willReturn('Gearing');
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getNamespace()->willReturn('Gearing');

        $this->module->normalizeQuotes('Gearing', 2)->willReturn('Gearing');

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
        "psr-4" : {
            "Gearing\\\\" : "src"
        }
    },
    "autoload-dev" : {
        "psr-4" : {
            "Gearing\\\\Test\\\\" : "test/unit"
        }
    },
    "config": {
        "secure-http": false
    },
    "repositories" : [
        {
            "type" : "composer",
            "url" : "http://satis"
        },
        { "packagist" : false }
    ***REMOVED***
}
EOS;

        $file = file_get_contents($this->file);

        $this->assertEquals($expected, $file);

    }
}
