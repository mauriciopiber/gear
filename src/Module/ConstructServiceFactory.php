<?php
namespace Gear\Module;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Gear\Module\ConstructService;

class ConstructServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ConstructService(
            $serviceLocator->get('Gear\Schema\Db'),
            $serviceLocator->get('Gear\Schema\Src'),
            $serviceLocator->get('Gear\Schema\App'),
            $serviceLocator->get('Gear\Schema\Controller'),
            $serviceLocator->get('Gear\Schema\Action'),
            $serviceLocator->get('Gear\Constructor\Db\DbConstructor'),
            $serviceLocator->get('Gear\Constructor\Src\SrcConstructor'),
            $serviceLocator->get('Gear\Constructor\App\AppService'),
            $serviceLocator->get('Gear\Constructor\Controller\ControllerConstructor'),
            $serviceLocator->get('Gear\Constructor\Action\ActionConstructor')
        );
    }
}
