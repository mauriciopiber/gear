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
        if (!isset($this->consoleController)) {
            $this->consoleController = $this->getServiceLocator()->get(
                ConsoleControllerService::class
            );
        }
        return $this->consoleController;
    }
}
