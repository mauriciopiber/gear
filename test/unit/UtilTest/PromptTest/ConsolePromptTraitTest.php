<?php
namespace GearTest\UtilTest\PromptTest;

use PHPUnit\Framework\TestCase;
use Gear\Console\Prompt\ConsolePromptTrait;

/**
 * @group Gear
 * @group ConsolePrompt
 */
class ConsolePromptTraitTest extends TestCase
{
    use ConsolePromptTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Console\Prompt\ConsolePrompt')->reveal();
        $this->setConsolePrompt($mocking);
        $this->assertEquals($mocking, $this->getConsolePrompt());
    }
}
