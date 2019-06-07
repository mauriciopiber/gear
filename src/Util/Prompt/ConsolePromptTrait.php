<?php
namespace Gear\Util\Prompt;

use Gear\Util\Prompt\ConsolePromptFactory;

trait ConsolePromptTrait
{
    protected $consolePrompt;

    public function getConsolePrompt()
    {
        return $this->consolePrompt;
    }

    public function setConsolePrompt(
        ConsolePrompt $consolePrompt
    ) {
        $this->consolePrompt = $consolePrompt;
        return $this;
    }
}
