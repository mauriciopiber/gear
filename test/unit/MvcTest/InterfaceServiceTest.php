<?php
namespace GearTest\ServiceTest\MvcTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;
use org\bovigo\vfs\vfsStream;
use Gear\Module;
use Gear\Creator\Template\TemplateService    ;
use Gear\Util\File\FileService;
use Gear\Util\String\StringService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Code\Code;
use Gear\Util\Dir\DirService;
use Gear\Mvc\InterfaceService;
use GearTest\UtilTestTrait;

/**
 * @group up1
 */
class InterfaceTestServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->module->getModuleName()->willReturn('MyModule');

        $this->baseDir = (new Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../view');

        $this->templates = $this->baseDir.'/../test/template/module/mvc/interface';

        $fileCreator    = $this->createFileCreator();

        $this->interface = new InterfaceService(
            $this->module->reveal(),
            $this->createFileCreator(),
            $this->createString(),
            $this->createCode(),
            $this->createDirService(),
            //$this->factoryService->reveal(),
            $this->createTableService(),
            $this->createArrayService(),
            $this->createInjector()
        );
    }

    public function getData()
    {
        return [
            [
                new \Gear\Schema\Src\Src([
                    'name' => 'MyInterface',
                    'type' => 'Interface',
                    'namespace' => 'Interfaces'
                ***REMOVED***),
                'simple-interface'
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src([
                    'name' => 'NamespaceInterface',
                    'type' => 'Interface',
                    'namespace' => 'My\Very\Long\Namespaces'
                ***REMOVED***),
                'simple-namespace'
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src([
                    'name' => 'ExtendsInterface',
                    'type' => 'Interface',
                    'extends' => 'Interfaces\MyAnotherInterface',
                    'namespace' => 'Interfaces'
                ***REMOVED***),
                'simple-extends'
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src([
                    'name' => 'SimpleDependencyInterface',
                    'type' => 'Interface',
                    'dependency' => 'Repository\MyDependency',
                    'namespace' => 'Interfaces'
                ***REMOVED***),
                'simple-dependency'
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src([
                    'name' => 'SimpleDependenciesInterface',
                    'type' => 'Interface',
                    'dependency' => 'Repository\MyDependencyOne,Repository\MyDependencyTwo,Repository\MyDependencyThree',
                    'namespace' => 'Interfaces'
                ***REMOVED***),
                'simple-dependencies'
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src([
                    'name' => 'CompleteInterface',
                    'type' => 'Interface',
                    'dependency' => 'Repository\MyDependencyOne,Repository\MyDependencyTwo,My\Very\Long\Namespaces\MyDependencyThree',
                    'extends' => 'Interfaces\MyAnotherInterface',
                    'namespace' => 'My\Very\Long\Namespaces'
                ***REMOVED***),
                'complete-interface'
            ***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @group src-mvc
     * @dataProvider getData
     */
    public function testCreateSrcInterface($src, $template)
    {
        $this->module->map('Interface')->willReturn(vfsStream::url('module'));
        $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module'));
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        $file = $this->interface->create($src);

        $expected = $this->templates.'/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
