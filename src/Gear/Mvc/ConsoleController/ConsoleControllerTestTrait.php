<?php
namespace Gear\Mvc\ConsoleController;

use Gear\Mvc\ConsoleController\ConsoleControllerTest;

trait ConsoleControllerTestTrait
{
    protected $consoleControllerTest;

    public function setConsoleControllerTest(ConsoleControllerTest $consoleControllerTest)
    {
        $this->consoleControllerTest = $consoleControllerTest;
        return $this;
    }

    public function getConsoleControllerTest()
    {
        if (!isset($this->consoleControllerTest)) {
            $this->consoleControllerTest = $this->getServiceLocator()->get(
                'Gear\Mvc\ConsoleController\ConsoleControllerTest'
            );
        }
        return $this->consoleControllerTest;
    }
}
