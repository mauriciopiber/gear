<?php
namespace Gear\Util\Console;

use Zend\Console\Adapter\Posix;

trait ConsoleAwareTrait
{
    protected $console;

    public function setConsole(Posix $console)
    {
        $this->console = $console;
        return $this;
    }

    public function getConsole()
    {
        return $this->console;
    }
}
