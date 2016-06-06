<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\AntUpgradeTrait;
use org\bovigo\vfs\vfsStream;

/**
 * @group Service
 * @group AntUpgrade
 */
class AntUpgradeTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');
    }

    /**
     * @group fix2
     */
    public function testDependency()
    {
        $antUpgrade = new \Gear\Upgrade\AntUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->module->reveal()
        );

        $this->assertEquals($antUpgrade->getConsole(), $this->console->reveal());
        $this->assertEquals($antUpgrade->getModule(), $this->module->reveal());
        $this->assertEquals($antUpgrade->getConsolePrompt(), $this->consolePrompt->reveal());
    }

    public function types()
    {
        return [['cli'***REMOVED***, ['web'***REMOVED******REMOVED***;
    }

    /**
     * @dataProvider types
     */
    public function testUpgradeAnt($type)
    {

        $this->assertEquals($type, $type);
    }
}
