<?php
namespace GearTest\UtilTest\ConsoleTest;

use PHPUnit\Framework\TestCase;
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
        $console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->setConsole($console->reveal());
        $this->assertEquals($console->reveal(), $this->getConsole());
    }
}