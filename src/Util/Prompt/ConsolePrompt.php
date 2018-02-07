<?php
namespace Gear\Util\Prompt;

use Zend\Console\Prompt;

class ConsolePrompt
{
    public $force;

    public function __construct($force)
    {
        $this->force = $force;
    }

    public function setForce($force)
    {
        $this->force = (bool) $force;
        return $this;
    }

    public function getForce()
    {
        return $this->force;
    }

    public function show($message)
    {
        if ($this->force === true) {
            return true;
        }

        $confirm = new Prompt\Confirm($message);
        $result = $confirm->show();
        return $result;
    }
}
