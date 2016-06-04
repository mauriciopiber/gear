<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\AbstractUpgradeTrait;

/**
 * @group Upgrade
 */
class AbstractUpgradeTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->upgrade = $this->getMockForAbstractClass('Gear\Upgrade\AbstractUpgrade', [***REMOVED***, '', false);
    }

    public function testConsole()
    {
        $this->upgrade->setConsole($this->console->reveal());
        $this->assertEquals($this->console->reveal(), $this->upgrade->getConsole());
    }


    /**
     * @group fix
     */
    public function testShowUpgrades()
    {
        $data = [
            'Linha1',
            'Linha2',
            'Linha3'
        ***REMOVED***;

        $this->console->writeLine('Realizados 3 upgrades.', 0, 3)->shouldBeCalled();
        $this->console->writeLine('Linha1', 0, 3)->shouldBeCalled();
        $this->console->writeLine('Linha2', 0, 3)->shouldBeCalled();
        $this->console->writeLine('Linha3', 0, 3)->shouldBeCalled();
        $this->console->writeLine('O sistema está atualizado.', 0, 3)->shouldBeCalled();

        $this->upgrade->setConsole($this->console->reveal());
        $this->upgrade->setUpgrades($data);

        $this->upgrade->showUpgrades();


    }

    public function testShowUpgraded()
    {
        $data = [***REMOVED***;

        $this->console->writeLine('O sistema está atualizado.', 0, 3)->shouldBeCalled();

        $this->upgrade->setConsole($this->console->reveal());
        $this->upgrade->setUpgrades($data);

        $this->upgrade->showUpgrades();

    }
}
