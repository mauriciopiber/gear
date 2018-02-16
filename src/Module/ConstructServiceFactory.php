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
            $serviceLocator->get('GearJson\Db'),
            $serviceLocator->get('GearJson\Src'),
            $serviceLocator->get('GearJson\App'),
            $serviceLocator->get('GearJson\Controller'),
            $serviceLocator->get('GearJson\Action'),
            $serviceLocator->get('Gear\Constructor\Db\DbConstructor'),
            $serviceLocator->get('Gear\Constructor\Src\SrcConstructor'),
            $serviceLocator->get('Gear\Constructor\App\AppService'),
            $serviceLocator->get('Gear\Constructor\Controller\ControllerConstructor'),
            $serviceLocator->get('Gear\Constructor\Action\ActionConstructor')
        );
    }
}
