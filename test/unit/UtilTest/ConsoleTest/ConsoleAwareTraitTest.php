<?php
namespace GearTest\UtilTest\ConsoleTest;

use PHPUnit\Framework\TestCase;
use Zend\Console\Adapter\Posix;
use Gear\Util\Console\ConsoleAwareTrait;

/**
 * @group Util
 *
 */
class ConsoleAwareTraitTest extends TestCase
{
    use ConsoleAwareTrait;

    public function testTrait()
    {
        $console = $this->prophesize(Posix::class);
        $this->setConsole($console->reveal());
        $this->assertEquals($console->reveal(), $this->getConsole());
    }
}