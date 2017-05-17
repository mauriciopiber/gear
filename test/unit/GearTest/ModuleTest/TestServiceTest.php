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


        $template       = new \Gear\Creator\Template\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');


        $this->string = new \GearBase\Util\String\StringService();

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module';

        $this->root = vfsStream::setup('module');
        vfsStream::newDirectory('test')->at($this->root);

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new \Gear\Module())->getLocation().'/../../data/edge-technologic/module/web/ant.yml')
        );

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->config = [***REMOVED***;

        $this->edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $this->edge->getAntModule('web')->willReturn($files)->shouldBeCalled();

        $this->gearConfig = $this->prophesize('GearBase\Config\GearConfig');



        $this->upgrade = new \Gear\Upgrade\AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->string,
            $this->config,
            $this->module->reveal(),
            $this->gearConfig->reveal()
        );

        $this->upgrade->setAntEdge($this->edge->reveal());
    }

    /**
     * @group build
     * @group n1s
     */
    public function testCreateModuleBuild()
    {

        $test = new \Gear\Module\TestService();
        $test->setModule($this->module->reveal());
        $test->setStringService($this->string);
        $test->setFileCreator($this->fileCreator);
        $test->setAntUpgrade($this->upgrade);
        //$test->setAntEdge($this->edge->reveal());***REMOVED***
        $this->gearConfig->getCurrentName()->willReturn('MyModule')->shouldBeCalled();

        $file = $test->copyBuildXmlFile();

        $this->assertFileExists($file);
    }
}