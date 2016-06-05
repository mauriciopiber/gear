<?php
namespace Gear\Util\Prompt;

use Zend\Console\Prompt;

class ConsolePrompt
{
    public function show($message)
    {
        $confirm = new Prompt\Confirm($message);
        $result = $confirm->show();

        if ($result) {

        }
    }
}
