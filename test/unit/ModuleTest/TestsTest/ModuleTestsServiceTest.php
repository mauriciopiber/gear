<?php
namespace GearTest\ModuleTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\Yaml\Parser;
use Zend\Console\Adapter\Posix;
use GearBase\Config\GearConfig;
use GearBase\Util\String\StringService;
use Gear\Module;
use Gear\Module\Tests\ModuleTestsService;
use Gear\Module\BasicModuleStructure;
use Gear\Upgrade\Ant\AntUpgrade;
use Gear\Edge\Ant\AntEdge;
use Gear\Util\Prompt\ConsolePrompt;
use GearTest\UtilTestTrait;

/**
 * @group Module
 * @group ModuleConstruct
 * @group Construct
 */
class ModuleTestsServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();

        $this->fileCreator    = $this->createFileCreator();

        $this->module = $this->prophesize(BasicModuleStructure::class);
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');

        $this->string = new StringService();

        $this->template = (new Module())->getLocation().'/../test/template/module';

        $this->root = vfsStream::setup('module');
        vfsStream::newDirectory('test')->at($this->root);

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new Module())->getLocation().'/../data/edge-technologic/module/web/ant.yml')
        );

        $this->console = $this->prophesize(Posix::class);
        $this->consolePrompt = $this->prophesize(ConsolePrompt::class);

        $this->config = [***REMOVED***;

        $this->edge = $this->prophesize(AntEdge::class);
        $this->edge->getAntModule('web')->willReturn($files)->shouldBeCalled();

        $this->gearConfig = $this->prophesize(GearConfig::class);



        $this->upgrade = new AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->string,
            $this->config,
            $this->module->reveal(),
            $this->gearConfig->reveal(),
            $this->edge->reveal()
        );

    }

    /**
     * @group build
     * @group n1s
     */
    public function testCreateModuleBuild()
    {
        $test = new ModuleTestsService();
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