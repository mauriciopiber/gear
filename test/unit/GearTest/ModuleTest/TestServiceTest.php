<?php
namespace GearTest\ModuleTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\Yaml\Parser;

/**
 * @group Module
 * @group ModuleConstruct
 * @group Construct
 */
class TestServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();


        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');


        $this->string = new \GearBase\Util\String\StringService();

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module';

        vfsStream::setup('module');

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new \Gear\Module())->getLocation().'/../../data/edge-technologic/module/web/ant.yml')
        );

        $this->edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $this->edge->getAntModule('web')->willReturn($files)->shouldBeCalled();


    }

    /**
     * @group n1
     */
    public function testCreateModuleBuild()
    {

        $test = new \Gear\Module\TestService();
        $test->setModule($this->module->reveal());
        $test->setStringService($this->string);
        $test->setFileCreator($this->fileCreator);
        $test->setAntEdge($this->edge->reveal());

        $file = $test->copyBuildXmlFile();

        $expected = $this->template.'/build.xml';

        //$this->assertEquals(
        //    file_get_contents($expected),
        //    file_get_contents($file)
        //);
    }
}