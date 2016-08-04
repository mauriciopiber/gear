<?php
namespace GearTest\CreatorTest;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @group RefactoringSrc
 * @group Code
 */
class CodeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->code = new \Gear\Creator\Code();

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');

        $this->code->setModule($this->module->reveal());
    }

    public function getDataImplements()
    {
        return [
            [
                new \GearJson\Src\Src(['name' => 'Test', 'type' => 'Service'***REMOVED***),
                [***REMOVED***,
                PHP_EOL
            ***REMOVED***,
            [
                new \GearJson\Src\Src(['name' => 'Test', 'type' => 'Service', 'implements' => 'Repository\ImplementsInterface'***REMOVED***),
                [***REMOVED***,
                ' implements ImplementsInterface'."\n",
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => 'Test',
                        'type' => 'Service',
                        'implements' => ['Repository\ImplementsInterface', 'Repository\SecondInterface'***REMOVED***
                    ***REMOVED***
                ),
                [***REMOVED***,
                ' implements'."\n".'    ImplementsInterface,'."\n".'    SecondInterface'."\n",
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => 'Test',
                        'type' => 'Service',
                        'implements' => ['Repository\ImplementsInterface', 'Repository\SecondInterface'***REMOVED***
                    ***REMOVED***
                ),
                ['ModuleOne\MyThirdInterface', 'ModuleTwo\MyFourInterface'***REMOVED***,
                ' implements'."\n".'    MyThirdInterface,'."\n".'    MyFourInterface,'."\n".'    ImplementsInterface,'."\n".'    SecondInterface'."\n",
            ***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider getDataImplements
     */
    public function testImplements($src, $additional, $template = null)
    {
        $this->assertEquals($template, $this->code->getImplements($src, $additional));
    }


    public function testGetFileDocs()
    {
        $src = new \GearJson\Src\Src([
            'name' => 'MyFileDocs',
            'type' => 'Repository',
            'namespace' => 'MyDocs'
        ***REMOVED***);

        $template = (new \Gear\Module())->getLocation().'/../../';
        $template .= 'test/template/module/code/file-docs/simple.phtml';

        $this->assertEquals(file_get_contents($template), $this->code->getFileDocs($src));
    }

    public function testGetClassDocs()
    {
        $src = new \GearJson\Src\Src([
            'name' => 'MyFileDocs',
            'type' => 'Repository',
            'namespace' => 'MyDocs'
        ***REMOVED***);

        $template = (new \Gear\Module())->getLocation().'/../../';
        $template .= 'test/template/module/code/class-docs/simple.phtml';

        $this->assertEquals(file_get_contents($template), $this->code->getClassDocs($src));
    }
}
