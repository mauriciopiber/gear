<?php
namespace Gear\Util\Prompt;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Util\Prompt\ConsolePrompt;

class ConsolePromptFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $request = $serviceLocator->get('Request');
        $factory = new ConsolePrompt(
            $request->getParam('force', false)
        );
        unset($serviceLocator);
        return $factory;
    }
}
