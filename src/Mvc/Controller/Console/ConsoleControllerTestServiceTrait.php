<?php
namespace Gear\Mvc\Controller\Console;

use Gear\Mvc\Controller\Console\ConsoleControllerTestService;

trait ConsoleControllerTestServiceTrait
{
    protected $consoleControllerTest;

    public function setConsoleControllerTest(ConsoleControllerTestService $consoleTest)
    {
        $this->consoleControllerTest = $consoleTest;
        return $this;
    }

    public function getConsoleControllerTest()
    {
        if (!isset($this->consoleControllerTest)) {
            $this->consoleControllerTest = $this->getServiceLocator()->get(
                ConsoleControllerTestService::class
            );
        }
        return $this->consoleControllerTest;
    }
}
