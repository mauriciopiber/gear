<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Creator\Component\Constructor\ConstructorParams;

/**
 * @group mvc-trait
 */
class TraitServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->templates = $this->baseDir.'/../../test/template/module/mvc/trait';

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $this->string  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $code = new \Gear\Creator\Code();
        $code->setModule($this->module->reveal());
        $code->setStringService($this->string);
        $code->setDirService(new \GearBase\Util\Dir\DirService());
        $constructorParams = new ConstructorParams($this->string);
        $code->setConstructorParams($constructorParams);

        $this->trait = new \Gear\Mvc\TraitService(
            /*
            $this->module->reveal(),
            $fileCreator,
            $stringService,
            $codeTest
            */
        );

        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setModule($this->module->reveal());
        $serviceManager->setStringService($this->string);

        $this->trait->setModule($this->module->reveal());
        $this->trait->setFileCreator($fileCreator);
        $this->trait->setStringService($this->string);
        $this->trait->setCode($code);
        $this->trait->setServiceManager($serviceManager);
    }

    public function getData()
    {
        return [
            [
                new \GearJson\Src\Src([
                    'name' => 'MyTrait',
                    'type' => 'Repository',
                ***REMOVED***),
                'simple-trait'
            ***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @group src-mvc
     * @dataProvider getData
     */
    public function testCreateSrcTrait($src, $template)
    {

        $this->module->map('Repository')->willReturn(vfsStream::url('module'));

        $file = $this->trait->createTrait($src, vfsStream::url('module'));

        $expected = $this->templates.'/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}