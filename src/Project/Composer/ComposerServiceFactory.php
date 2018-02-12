<?php
namespace Gear\Project\Composer;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Project\Composer\ComposerService;
use Gear\Creator\FileCreator\FileCreator;

/**
 * @deprecated
 */
class ComposerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerService(
            $serviceLocator->get(FileCreator::class),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('scriptService'),
            $serviceLocator->get('Gear\Edge\Composer\ComposerEdge'),
            $serviceLocator->get('Gear\Util\Vector\ArrayService')
        );
        unset($serviceLocator);
        return $factory;
    }
}
