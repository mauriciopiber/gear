<?php
namespace Gear\Edge\Composer;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Edge\Composer\ComposerEdge;
use Gear\Util\Yaml\YamlService;

class ComposerEdgeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ComposerEdge(
            $container->get(YamlService::class)
        );

        return $factory;
    }
}
