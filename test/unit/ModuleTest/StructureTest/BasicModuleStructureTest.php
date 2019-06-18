<?php
namespace GearTest\ModuleTest\StructureTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\Dir\DirService;
use Gear\Util\File\FileService;
use Gear\Util\String\StringService;

/**
 * @group Module
 * @group Module-Structure
 */
class ModuleStructureTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();
        $this->module = vfsStream::setup('moduleDir');

        $this->stringService = new StringService();
        $this->dirService = $this->prophesize(DirService::class);
        $this->fileService = $this->prophesize(FileService::class);

        $this->basicModuleStructure = new ModuleStructure(
            $this->stringService,
            $this->dirService->reveal(),
            $this->fileService->reveal()
        );
    }


    public function normalizeDoubleQuote()
    {
        return [
            ['My\\Data', 'My\\\\Data'***REMOVED***,
            ['My\\\Data', 'My\\\\Data'***REMOVED***,
            ['My\\\\Data', 'My\\\\Data'***REMOVED***,
            ['My\\\\\\\\\Data', 'My\\\\Data'***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider normalizeDoubleQuote
     */
    public function testNormalizeDoubleQuote($input, $expect)
    {
        $output = $this->basicModuleStructure->normalizeQuotes($input, 2);
        $this->assertEquals($expect, $output);
    }

    public function normalizeSingleQuote()
    {
        return [
            ['My\\Data', 'My\\Data'***REMOVED***,
            ['My\\\Data', 'My\\Data'***REMOVED***,
            ['My\\\\Data', 'My\\Data'***REMOVED***,
            ['My\\\\\\\\Data', 'My\\Data'***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider normalizeSingleQuote
     */
    public function testNormalizeSingleQuote($input, $expect)
    {
        $output = $this->basicModuleStructure->normalizeQuotes($input, 1);
        $this->assertEquals($expect, $output);
    }

    public function wrapVfs($path)
    {
        return vfsStream::url($path);
    }

    /**
     * @group wri
     */
    public function testCreateWebStructure()
    {
        $this->basicModuleStructure->setMainFolder(vfsStream::url('module'));
        $this->basicModuleStructure->setModuleName('WebStructure');
        $this->basicModuleStructure->setType('web');

        $paths = [
            'module',
            'module/build',
            'module/config',
            'module/config/autoload',
            'module/config/ext',
            'module/src',
            'module/src/Controller',
            'module/src/Controller/Plugin',
            'module/src/Form',
            'module/src/View',
            'module/src/View/Helper',
            'module/src/Filter',
            'module/src/ValueObject',
            'module/src/Form/Search',
            'module/src/Entity',
            'module/src/Fixture',
            'module/src/Service',
            'module/src/Repository',
            'module/schema',
            'module/data',
            'module/data/session',
            'module/data/cache',
            'module/data/cache/configcache',
            'module/data/migrations',
            'module/data/logs',
            'module/data/DoctrineModule',
            'module/data/DoctrineModule/cache',
            'module/data/DoctrineORMModule',
            'module/data/DoctrineORMModule/Proxy',
            'module/data/_files',
            // 'module/data/session',
            'module/node_modules',
            'module/public',
            'module/public/upload',
            'module/public/_temp',
            'module/public/css',
            'module/public/js',
            'module/public/js/app',
            'module/public/js/app/controller',
            'module/public/js/app/service',
            'module/public/js/spec',
            'module/public/js/spec/unit',
            'module/public/js/spec/unit/controllerSpec',
            'module/public/js/spec/unit/serviceSpec',
            'module/public/js/spec/integration',
            'module/public/js/spec/mock',
            'module/public/js/spec/e2e',
            'module/public/js/spec/e2e/index',
            // 'module/public/js/spec/e2e/support',
            'module/public/js/spec/e2e/support/index',
            //'module/vendor',
            'module/language',
            'module/language/route',
            'module/docs',
            'module/script',
            'module/view',
            'module/view/web-structure',
            'module/view/web-structure/index',
            'module/view/error',
            'module/view/layout',
            'module/test',
            'module/test/unit',
            'module/test/unit/ControllerTest',
            'module/test/unit/ControllerTest/PluginTest',
            'module/test/unit/ServiceTest',
            'module/test/unit/RepositoryTest',
            'module/test/unit/ValueObjectTest',
            'module/test/unit/EntityTest',
            'module/test/unit/FilterTest',
            'module/test/unit/ViewTest',
            'module/test/unit/ViewTest/HelperTest',
            'module/test/unit/FormTest',
            'module/test/unit/FormTest/SearchTest',
            'module/test/_data',
            'module/test/_support'
        ***REMOVED***;

        foreach ($paths as $path) {
            $this->dirService->mkDir($this->wrapVfs($path))
                ->shouldBeCalled();
        }

        $excludePaths = [
            'module/src/Factory',
            'module/test/unit/FactoryTest'
        ***REMOVED***;

        foreach ($excludePaths as $path) {
            $this->dirService->mkDir($this->wrapVfs($path))
                ->shouldNotBeCalled();
        }

        $writable = [
            'module/build',
            'module/data/session',
            'module/data/logs',
            'module/data/migrations',
            'module/public/upload',
            'module/public/_temp',
            'module/node_modules',
            'module/data/cache/configcache',
            'module/data/DoctrineORMModule/Proxy',
            'module/data/DoctrineModule/cache',
            'module/test/_support',
        ***REMOVED***;

        foreach ($writable as $path) {

            $this->assertContains($path, $paths);
            $this->dirService->writable($this->wrapVfs($path))
                ->shouldBeCalled();
        }

        $this->basicModuleStructure->prepare();
        $this->basicModuleStructure->write();

        $this->assertEquals('WebStructure', $this->basicModuleStructure->getModuleName());
    }

    /**
     * @group wri
     */
    public function testCreateCliStructure()
    {
        $this->basicModuleStructure->setMainFolder(vfsStream::url('module'));
        $this->basicModuleStructure->setModuleName('WebStructure');
        $this->basicModuleStructure->setType('cli');

        $paths = [
            'module',
            'module/build',
            'module/config',
            'module/config/autoload',
            'module/config/ext',
            'module/src',
            'module/src/Controller',
            'module/src/Controller/Plugin',
            'module/src/Form',
            'module/src/Filter',
            'module/src/ValueObject',
            'module/src/Entity',
            'module/src/Fixture',
            'module/src/Service',
            'module/src/Repository',
            'module/schema',
            'module/data',
            'module/data/session',
            'module/data/cache',
            'module/data/cache/configcache',
            //'module/data/migrations',
            'module/data/logs',
            'module/data/DoctrineModule',
            'module/data/DoctrineModule/cache',
            'module/data/DoctrineORMModule',
            'module/data/DoctrineORMModule/Proxy',
            //'module/data/_files',
            'module/public',
            'module/docs',
            'module/script',
            'module/test',
            'module/test/unit',
            'module/test/unit/ControllerTest',
            'module/test/unit/ControllerTest/PluginTest',
            'module/test/unit/ServiceTest',
            'module/test/unit/RepositoryTest',
            'module/test/unit/ValueObjectTest',
            'module/test/unit/EntityTest',
            'module/test/unit/FilterTest',
            'module/test/unit/FormTest',
            'module/test/_data',
            'module/test/_support'
        ***REMOVED***;

        foreach ($paths as $path) {
            $this->dirService->mkDir($this->wrapVfs($path))
                ->shouldBeCalled();
        }

        $excludePaths = [
            'module/src/Factory',
            'module/test/unit/FactoryTest'

        ***REMOVED***;

        foreach ($excludePaths as $path) {
            $this->dirService->mkDir($this->wrapVfs($path))
                ->shouldNotBeCalled();
        }

         $writable = [
            'module/build',
            'module/data/session',
            'module/data/logs',
            'module/data/cache/configcache',
            'module/data/DoctrineORMModule/Proxy',
            'module/data/DoctrineModule/cache',
            'module/test/_support',
        ***REMOVED***;

        foreach ($writable as $path) {

            $this->assertContains($path, $paths);
            $this->dirService->writable($this->wrapVfs($path))
                ->shouldBeCalled();
        }

        $this->basicModuleStructure->prepare();
        $this->basicModuleStructure->write();

    }

    /**
     * @group f1
     */
    public function testCreateApiStructure()
    {
        $this->basicModuleStructure->setMainFolder(vfsStream::url('module'));
        $this->basicModuleStructure->setModuleName('WebStructure');
        $this->basicModuleStructure->setType('api');

        $paths = [
            'module',
            'module/build',
            'module/config',
            'module/config/autoload',
            'module/config/ext',
            'module/src',
            'module/src/Controller',
            'module/src/Controller/Plugin',
            'module/src/Form',
            'module/src/Filter',
            'module/src/ValueObject',
            'module/src/Entity',
            'module/src/Fixture',
            'module/src/Service',
            'module/src/Repository',
            'module/schema',
            'module/data',
            'module/data/session',
            'module/data/cache',
            'module/data/cache/configcache',
            'module/data/migrations',
            'module/data/logs',
            'module/data/DoctrineModule',
            'module/data/DoctrineModule/cache',
            'module/data/DoctrineORMModule',
            'module/data/DoctrineORMModule/Proxy',
            'module/data/_files',
            // 'module/data/session',
            'module/public',
            //'module/vendor',
            'module/language',
            'module/language/route',
            'module/docs',
            'module/script',
            'module/test',
            'module/test/unit',
            'module/test/unit/ControllerTest',
            'module/test/unit/ControllerTest/PluginTest',
            'module/test/unit/ServiceTest',
            'module/test/unit/RepositoryTest',
            'module/test/unit/ValueObjectTest',
            'module/test/unit/EntityTest',
            'module/test/unit/FilterTest',
            'module/test/unit/FormTest',
            //'module/test/unit/FormTest/SearchTest',
            'module/test/_data',
            'module/test/_support'
        ***REMOVED***;

        foreach ($paths as $path) {
            $this->dirService->mkDir($this->wrapVfs($path))
                ->shouldBeCalled();
        }

        $excludePaths = [
            'module/src/Factory',
            'module/test/unit/FactoryTest'
        ***REMOVED***;

        foreach ($excludePaths as $path) {
            $this->dirService->mkDir($this->wrapVfs($path))
                ->shouldNotBeCalled();
        }

        $writable = [
            'module/build',
            'module/data/session',
            'module/data/migrations',
            'module/data/logs',
            'module/data/cache/configcache',
            'module/data/DoctrineORMModule/Proxy',
            'module/data/DoctrineModule/cache',
            'module/test/_support',
        ***REMOVED***;

        foreach ($writable as $path) {

            $this->assertContains($path, $paths);
            $this->dirService->writable($this->wrapVfs($path))
                ->shouldBeCalled();
        }

        $this->basicModuleStructure->prepare();
        $this->basicModuleStructure->write();
    }

    const SRC_STRUCTURE = [
        'module',
        'module/build',
        'module/config',
        'module/config/autoload',
        'module/config/ext',
        'module/src',
        'module/data',
        'module/public',
        'module/script',
        'module/docs',
        'module/test',
        'module/test/unit',
        'module/test/_data',
        'module/test/_support',
    ***REMOVED***;

    public function src()
    {
        return [
            ['src'***REMOVED***,
            ['src-zf2'***REMOVED***,
            ['src-zf3'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider src
     */
    public function testCreateSrcStructure($type)
    {
        $this->basicModuleStructure->setMainFolder(vfsStream::url('module'));
        $this->basicModuleStructure->setModuleName('WebStructure');
        $this->basicModuleStructure->setType($type);

        $paths = self::SRC_STRUCTURE;

        foreach ($paths as $path) {
            $this->dirService->mkDir($this->wrapVfs($path))
                ->shouldBeCalled();
        }

        $writable = [
            'module/build',
            'module/test/_support',
        ***REMOVED***;

        foreach ($writable as $path) {

            $this->assertContains($path, $paths);
            $this->dirService->writable($this->wrapVfs($path))
                ->shouldBeCalled();
        }

        $this->basicModuleStructure->prepare();
        $this->basicModuleStructure->write();
    }
}
