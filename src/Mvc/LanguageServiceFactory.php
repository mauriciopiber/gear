<?php
namespace Gear\Mvc;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\LanguageService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;

class LanguageServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new LanguageService(
            $container->get(ModuleStructure::class),
            $container->get(StringService::class),
            $container->get(FileCreator::class)
        );

        return $factory;
    }
}
