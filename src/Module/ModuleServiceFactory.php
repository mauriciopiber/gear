<?php
namespace Gear\Module;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\ModuleService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Constructor\Controller\ControllerConstructor;
use Gear\Constructor\Action\ActionConstructor;
use Gear\Docker\DockerService;
use Gear\Schema\Schema\Loader\SchemaLoaderService;
use Gear\Schema\Schema\SchemaService;
use Gear\Module\Tests\ModuleTestsService;
use Gear\Kube\KubeService;

class ModuleServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new ModuleService(
            $container->get(FileCreator::class),
            $container->get('Gear\Util\String\StringService'),
            $container->get(ModuleStructure::class),
            $container->get('Gear\Module\Docs\Docs'),
            $container->get('Gear\Module\Composer'),
            $container->get(ModuleTestsService::class),
            $container->get('Gear\Module\Node\Package'),
            $container->get('Gear\Mvc\LanguageService'),
            $container->get(SchemaService::class),
            $container->get(SchemaLoaderService::class),
            $container->get('Gear\Mvc\Config\ConfigService'),
            $container->get('Gear\Mvc\View\ViewService'),
            $container->get('Request'),
            $container->get('Gear\Autoload\ComposerAutoload'),
            $container->get('config'),
            $container->get('Gear\Util\Dir\DirService'),
            $container->get('Gear\Config\GearConfig'),
            $container->get(ControllerConstructor::class),
            $container->get(ActionConstructor::class),
            $container->get(DockerService::class),
            $container->get(KubeService::class)
        );
    }
}
