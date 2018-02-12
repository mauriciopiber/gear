<?php
namespace GearTest\ModuleTest\NodeTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\Yaml\Parser;
use GearTest\UtilTestTrait;
use Gear\Edge\Npm\NpmEdge;

/**
 * @group Module
 * @group ModuleConstruct
 * @group Construct
 */
class PackageTest extends TestCase
{
    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();


        $template       = new \Gear\Creator\Template\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');


        $this->string = new \GearBase\Util\String\StringService();

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module';

        vfsStream::setup('module');

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new \Gear\Module())->getLocation().'/../data/edge-technologic/module/web/npm.yml')
        );

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->config = [***REMOVED***;

        $this->edge = $this->prophesize(NpmEdge::class);
        $this->edge->getNpmModule('web')->willReturn($files)->shouldBeCalled();



        $this->upgrade = new \Gear\Upgrade\Npm\NpmUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->config,
            $this->module->reveal()
        );

        $this->upgrade->setNpmEdge($this->edge->reveal());
    }

    /**
     * @group n2
     */
    public function testCreateModulePackage()
    {

        $test = new \Gear\Module\Node\Package();
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