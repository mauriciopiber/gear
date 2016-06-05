<?php
namespace GearTest\UtilTest\PromptTest;

use GearBaseTest\AbstractTestCase;
use Gear\Util\Prompt\ConsolePromptTrait;

/**
 * @group Gear
 * @group ConsolePrompt
 */
class ConsolePromptTraitTest extends AbstractTestCase
{
    use ConsolePromptTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Util\Prompt\ConsolePrompt')->reveal();
        $this->setConsolePrompt($mocking);
        $this->assertEquals($mocking, $this->getConsolePrompt());
    }
}
