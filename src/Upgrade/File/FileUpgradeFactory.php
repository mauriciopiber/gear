<?php
namespace Gear\Upgrade\File;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Upgrade\File\FileUpgrade;
use Gear\Edge\File\FileEdge;
use Gear\Module\Structure\ModuleStructure;

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
            $container->get('Gear\Module\Tests'),
            $container->get('Gear\Module\Docs\Docs')
        );
        
        return $factory;
    }
}
