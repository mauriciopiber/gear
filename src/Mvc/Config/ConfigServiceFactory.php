<?php
namespace Gear\Mvc\Config;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Config\ConfigService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Creator\FileCreator\FileCreator;
use \Gear\Mvc\Config\AssetManager;
use \Gear\Mvc\Config\RouterManager;
use \Gear\Mvc\Config\ConsoleRouterManager;
use \Gear\Mvc\Config\NavigationManager;
use \Gear\Mvc\Config\UploadImageManager;
use \Gear\Mvc\Config\ServiceManager;
use \Gear\Mvc\Config\ControllerManager;
use \Gear\Mvc\Config\ControllerPluginManager;
use \Gear\Mvc\Config\ViewHelperManager;

/**
 * PHP Version 5
 *
 * @category Mvc
 * @package Gear\Mvc
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://piber.network
 */
class ConfigServiceFactory implements FactoryInterface
{
    /**
     * Create ConfigService
     *
     * @param ContainerInterface $container Container
     *
     * @return ConfigService
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new ConfigService(
            $container->get(ModuleStructure::class),
            $container->get(StringService::class),
            $container->get(FileCreator::class),
            $container->get(AssetManager::class),
            $container->get(RouterManager::class),
            $container->get(ConsoleRouterManager::class),
            $container->get(NavigationManager::class),
            $container->get(UploadImageManager::class),
            $container->get(ServiceManager::class),
            $container->get(ControllerManager::class),
            $container->get(ControllerPluginManager::class),
            $container->get(ViewHelperManager::class)
        );
        return $factory;
    }
}
