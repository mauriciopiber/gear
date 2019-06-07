<?php
namespace Gear\Module;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

use Gear\Module\ConstructService;

class ConstructServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new ConstructService(
            $container->get('Gear\Schema\Db'),
            $container->get('Gear\Schema\Src'),
            $container->get('Gear\Schema\App'),
            $container->get('Gear\Schema\Controller'),
            $container->get('Gear\Schema\Action'),
            $container->get('Gear\Constructor\Db\DbConstructor'),
            $container->get('Gear\Constructor\Src\SrcConstructor'),
            $container->get('Gear\Constructor\App\AppService'),
            $container->get('Gear\Constructor\Controller\ControllerConstructor'),
            $container->get('Gear\Constructor\Action\ActionConstructor')
        );
    }
}
