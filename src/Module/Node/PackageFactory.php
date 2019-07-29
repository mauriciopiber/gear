<?php
namespace Gear\Module\Node;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Module\Node\Package;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Upgrade\Npm\NpmUpgrade;

class PackageFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new Package(
            $container->get(ModuleStructure::class),
            $container->get(StringService::class),
            $container->get(FileCreator::class),
            $container->get(NpmUpgrade::class)
        );

        return $factory;
    }
}
