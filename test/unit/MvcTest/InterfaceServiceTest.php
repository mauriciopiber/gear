<?php
namespace GearTest\ServiceTest\MvcTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Module;
use Gear\Creator\Template\TemplateService    ;
use Gear\Util\File\FileService;
use Gear\Util\String\StringService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\Code;
use Gear\Util\Dir\DirService;
use Gear\Mvc\InterfaceService;
use GearTest\UtilTestTrait;

/**
 * @group up1
 */
class InterfaceTestServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');

        $this->baseDir = (new Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../view');

        $this->templates = $this->baseDir.'/../test/template/module/mvc/interface';

        $template       = new TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService    = new FileService();
        $this->string  = new StringService();
        $fileCreator    = new FileCreator($fileService, $template);

        $code = new Code();
        $code->setModule($this->module->reveal());
        $code->setStringService($this->string);
        $code->setDirService(new DirService());

        $this->interface = new InterfaceService(
            /*
            $this->module->reveal(),
            $fileCreator,
            $stringService,
            $codeTest
            */
        );

        $this->interface->setModule($this->module->reveal());
        $this->interface->setFileCreator($fileCreator);
        $this->interface->setStringService($this->string);
        $this->interface->setCode($code);
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

        $file = $this->interface->create($src);

        $expected = $this->templates.'/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}