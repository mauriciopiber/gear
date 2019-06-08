<?php
namespace Gear\Upgrade\File;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Upgrade\File\FileUpgrade;
use Gear\Edge\File\FileEdge;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Tests\ModuleTestsService;

class FileUpgradeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new FileUpgrade(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Config\GearConfig'),
            $container->get(FileEdge::class),
            $container->get('Gear\Util\Prompt\ConsolePrompt'),
            $container->get('Gear\Module'),
            $container->get(ModuleTestsService::class),
            $container->get('Gear\Module\Docs\Docs')
        );

        return $factory;
    }
}
