<?php
namespace Gear\Mvc\Controller\Console;

use Gear\Mvc\Controller\Console\ConsoleControllerService;

trait ConsoleControllerServiceTrait
{
    protected $consoleController;

    public function setConsoleController(ConsoleControllerService $consoleController)
    {
        $this->consoleController = $consoleController;
        return $this;
    }

    public function getConsoleController()
    {
        return $this->consoleController;
    }
}
