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

    public function setUp()
    {
        parent::setUp();

        $template       = new TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));

        $fileService    = new FileService();
        $fileCreator    = new FileCreator($fileService, $template);

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
     * @group x4
     */
    public function testTokenizeNamespaceShort()
    {
        $expected = [
            'First',
            'Second'
        ***REMOVED***;
        $this->assertEquals(
            $expected,
            $this->composer->tokenizeNamespace('First\Second')
        );
        $this->assertEquals(
            $expected,
            $this->composer->tokenizeNamespace('First\\Second')
        );
        $this->assertEquals(
            $expected,
            $this->composer->tokenizeNamespace('First\\\Second')
        );
        $this->assertEquals(
            $expected,
            $this->composer->tokenizeNamespace('First\\\\Second')
        );
        $this->assertEquals(
            $expected,
            $this->composer->tokenizeNamespace('First\\\\\Second')
        );
    }

    /**
     * @group x4
     */
    public function testTokenizeNamespaceLong()
    {
        $expected = [
            'First',
            'Second',
            'Third',
            'Four',
            'Five'
        ***REMOVED***;
        $this->assertEquals(
            $expected,
            $this->composer->tokenizeNamespace('First\Second\Third\Four\Five')
        );
        $this->assertEquals(
            $expected,
            $this->composer->tokenizeNamespace('First\\Second\\Third\\Four\\Five')
        );
        $this->assertEquals(
            $expected,
            $this->composer->tokenizeNamespace('First\\\Second\\\Third\\\Four\\\Five')
        );
        $this->assertEquals(
            $expected,
            $this->composer->tokenizeNamespace('First\\\\Second\\\\Third\\\\Four\\\\Five')
        );
        $this->assertEquals(
            $expected,
            $this->composer->tokenizeNamespace('First\\\\\Second\\\\\Third\\\\\Four\\\\\Five')
        );
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

        $created = $this->composer->createComposerAsProject($name);

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
    "autoload-dev": {
        "psr-4": {
            "GearTest\\\\GearingTest\\\\" : "test/unit"
        }
    },
    "repositories" : [
        {
            "type" : "composer",
            "url" : "https://mirror.piber.network"
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

        $created = $this->composer->createComposerAsProject($name);

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
    "autoload-dev": {
        "psr-4": {
            "GearTest\\\\GearingTest\\\\MyOtherTest\\\\" : "test/unit"
        }
    },
    "repositories" : [
        {
            "type" : "composer",
            "url" : "https://mirror.piber.network"
        },
        { "packagist" : false }
    ***REMOVED***
}
EOS;

        $file = file_get_contents($this->file);

        $this->assertEquals($expected, $file);

    }
}
