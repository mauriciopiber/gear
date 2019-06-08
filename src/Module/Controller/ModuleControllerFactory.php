<?php
namespace Gear\Module\Controller;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Cache\CacheService;
use Gear\Module\ModuleService;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Module\Diagnostic\DiagnosticService;
use Gear\Module\ConstructService;
use Gear\Module\Upgrade\ModuleUpgrade;
use Gear\Module\Config\ApplicationConfig;
use Gear\Autoload\ComposerAutoload;
use Gear\Module\Controller\ModuleController;

class ModuleControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $moduleController = new ModuleController(
            $container->get(ModuleService::class),
            $container->get(ComposerAutoload::class),
            $container->get(ApplicationConfig::class),
            $container->get(CacheService::class)//,
            // $container->get(EntityService::class),
            // $container->get(FixtureService::class),
            // $container->get(DiagnosticService::class),
            // $container->get(ConstructService::class),
            // $container->get(ModuleUpgrade::class)
        );
        return $moduleController;
    }
}
