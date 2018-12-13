<?php
namespace Gear\Util\Prompt;

use Gear\Util\Prompt\ConsolePromptFactory;

trait ConsolePromptTrait
{
    protected $consolePrompt;

    public function getConsolePrompt()
    {
        if (!isset($this->consolePrompt)) {
            $name = 'Gear\Util\Prompt\ConsolePrompt';
            $this->consolePrompt = $this->getServiceLocator()->get($name);
        }
        return $this->consolePrompt;
    }

    public function setConsolePrompt(
        ConsolePrompt $consolePrompt
    ) {
        $this->consolePrompt = $consolePrompt;
        return $this;
    }
}
