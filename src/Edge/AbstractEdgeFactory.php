<?php
namespace Gear\Edge;

use Zend\ServiceManager\Factory\AbstractFactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Edge\AbstractEdgeInterface;
use Gear\Util\Yaml\YamlService;

class AbstractEdgeFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        if (!class_exists($requestedName)) {
          return false;
        }
        //var_dump($requestedName);

        $interfaces = class_implements($requestedName);

        return (isset($interfaces[AbstractEdgeInterface::class***REMOVED***));
    }

    public function __invoke(ContainerInterface $container, $requestedName, $options = [***REMOVED***)
    {
        return new $requestedName(
            $container->get(YamlService::class)
        );
    }
}
