<?php
namespace Gear\Mvc\Config;

trait ConsoleRouterManagerTrait
{
    protected $consoleRouter;

    public function getConsoleRouterManager()
    {
        if (!isset($this->consoleRouter)) {
            $this->consoleRouter = $this->getServiceLocator()->get('Gear\Mvc\Config\ConsoleRouter');
        }
        return $this->consoleRouter;
    }

    public function setConsoleRouterManager($consoleRouter)
    {
        $this->consoleRouter = $consoleRouter;
        return $this;
    }
}
