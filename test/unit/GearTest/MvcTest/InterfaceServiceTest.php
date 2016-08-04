<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Mvc
 * @group Interface
 */
class InterfaceTestServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->templates = $this->baseDir.'/../../test/template/module/mvc/interface';

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $this->string  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\File($fileService, $template);

        $code = new \Gear\Creator\Code();
        $code->setModule($this->module->reveal());
        $code->setStringService($this->string);
        $code->setDirService(new \GearBase\Util\Dir\DirService());

        $this->interface = new \Gear\Mvc\InterfaceService(
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
                new \GearJson\Src\Src([
                    'name' => 'MyInterface',
                    'type' => 'Interface',
                    'namespace' => 'Interfaces'
                ***REMOVED***),
                'simple-interface'
            ***REMOVED***,
            [
                new \GearJson\Src\Src([
                    'name' => 'NamespaceInterface',
                    'type' => 'Interface',
                    'namespace' => 'My\Very\Long\Namespaces'
                ***REMOVED***),
                'simple-namespace'
            ***REMOVED***,
            [
                new \GearJson\Src\Src([
                    'name' => 'SimpleExtendsInterface',
                    'type' => 'Interface',
                    'extends' => 'Interfaces\MyAnotherInterface',
                    'namespace' => 'Interfaces'
                ***REMOVED***),
                'simple-extends'
            ***REMOVED***,
            [
                new \GearJson\Src\Src([
                    'name' => 'SimpleDependencyInterface',
                    'type' => 'Interface',
                    'dependency' => 'Repository\MyDependency'
                ***REMOVED***),
                'simple-dependency'
            ***REMOVED***,
            [
                new \GearJson\Src\Src([
                    'name' => 'SimpleDependenciesExtendsInterface',
                    'type' => 'Interface',
                    'dependency' => 'Repository\MyDependencyOne,Repository\MyDependencyTwo,Repository\MyDependencyThree'
                ***REMOVED***),
                'simple-dependencies'
            ***REMOVED***,
            [
                new \GearJson\Src\Src([
                    'name' => 'CompleteInterface',
                    'type' => 'Interface',
                    'dependency' => 'Repository\MyDependencyOne,Repository\MyDependencyTwo,My\Very\Long\Namespace\MyDependencyThree',
                    'extends' => 'Interface\MyAnotherInterface',
                    'namespace' => 'My\Very\Long\Namespaces'
                ***REMOVED***),
                'complete-interface'
            ***REMOVED***,
        ***REMOVED***;
    }

    /**
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