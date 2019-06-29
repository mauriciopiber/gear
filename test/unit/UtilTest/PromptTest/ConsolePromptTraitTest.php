<?php
namespace GearTest\UtilTest\PromptTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Prompt\ConsolePrompt;
use Gear\Util\Prompt\ConsolePromptTrait;

/**
 * @group Gear
 * @group ConsolePrompt
 */
class ConsolePromptTraitTest extends TestCase
{
    use ConsolePromptTrait;

    public function testSet()
    {
        $mocking = $this->prophesize(ConsolePrompt::class)->reveal();
        $this->setConsolePrompt($mocking);
        $this->assertEquals($mocking, $this->getConsolePrompt());
    }
}
