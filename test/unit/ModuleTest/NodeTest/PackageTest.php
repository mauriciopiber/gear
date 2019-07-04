<?php
namespace GearTest\ModuleTest\NodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\String\StringService;
use Gear\Upgrade\Npm\NpmUpgrade;
use Gear\Module\Node\Package;
use Gear\Module;
use Zend\Console\Adapter\Posix;
use Gear\Util\Prompt\ConsolePrompt;
use Gear\Module\Structure\ModuleStructure;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\Yaml\Parser;
use GearTest\UtilTestTrait;
use Gear\Edge\Npm\NpmEdge;
use Gear\Config\GearConfig;

/**
 * @group Module
 * @group ModuleConstruct
 * @group Construct
 */
class PackageTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->fileCreator    = $this->createFileCreator();

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');


        $this->string = new StringService();

        $this->template = (new Module())->getLocation().'/../test/template/module';

        vfsStream::setup('module');

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new Module())->getLocation().'/../data/edge-technologic/module/web/npm.yml')
        );

        $this->console = $this->prophesize(Posix::class);
        $this->consolePrompt = $this->prophesize(ConsolePrompt::class);

        $this->config = [***REMOVED***;

        $this->edge = $this->prophesize(NpmEdge::class);
        $this->edge->getNpmModule('web')->willReturn($files)->shouldBeCalled();

        $this->gearConfig = $this->prophesize(GearConfig::class);

        $this->upgrade = new NpmUpgrade(
            $this->module->reveal(),
            $this->gearConfig->reveal(),
            $this->edge->reveal(),
            $this->consolePrompt->reveal(),
            $this->string
        );

        $this->upgrade->setNpmEdge($this->edge->reveal());
    }

    /**
     * @group n2
     */
    public function testCreateModulePackage()
    {

        $test = new Module\Node\Package();
        $test->setModule($this->module->reveal());
        $test->setStringService($this->string);
        $test->setFileCreator($this->fileCreator);
        $test->setNpmUpgrade($this->upgrade);
        //$test->setAntEdge($this->edge->reveal());

        $file = $test->create();

        $expected = $this->template.'/package.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
