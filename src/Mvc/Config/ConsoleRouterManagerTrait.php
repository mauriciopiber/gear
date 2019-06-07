<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\ConsoleRouterManager;

trait ConsoleRouterManagerTrait
{
    protected $consoleRouter;

    public function getConsoleRouterManager()
    {
        return $this->consoleRouter;
    }

    public function setConsoleRouterManager($consoleRouter)
    {
        $this->consoleRouter = $consoleRouter;
        return $this;
    }
}
