<?php
namespace Gear\Project\Composer;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Project\Composer\ComposerService;
use Gear\Creator\FileCreator\FileCreator;

/**
 * @deprecated
 */
class ComposerServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ComposerService(
            $container->get(FileCreator::class),
            $container->get('Gear\Util\String\StringService'),
            $container->get('scriptService'),
            $container->get('Gear\Edge\Composer\ComposerEdge'),
            $container->get('Gear\Util\Vector\ArrayService')
        );
        
        return $factory;
    }
}
