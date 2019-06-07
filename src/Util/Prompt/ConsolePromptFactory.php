<?php
namespace Gear\Util\Prompt;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Util\Prompt\ConsolePrompt;

class ConsolePromptFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $request = $container->get('Request');
        $factory = new ConsolePrompt(
            $request->getParam('force', false)
        );
        
        return $factory;
    }
}
