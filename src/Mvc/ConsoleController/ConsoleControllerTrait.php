<?php
namespace Gear\Mvc\ConsoleController;

use Gear\Mvc\ConsoleController\ConsoleController;

trait ConsoleControllerTrait
{
    protected $consoleController;

    public function setConsoleController(ConsoleController $consoleController)
    {
        $this->consoleController = $consoleController;
        return $this;
    }

    public function getConsoleController()
    {
        if (!isset($this->consoleController)) {
            $this->consoleController = $this->getServiceLocator()->get(
                ConsoleController::class
            );
        }
        return $this->consoleController;
    }
}
