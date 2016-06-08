<?php
namespace Gear\Project\Composer;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Project\Composer\ComposerService;

class ComposerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerService(
            $serviceLocator->get('Gear\FileCreator'),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('scriptService'),
            $serviceLocator->get('Gear\Edge\ComposerEdge'),
            $serviceLocator->get('Gear\Util\Array')
        );
        unset($serviceLocator);
        return $factory;
    }
}
