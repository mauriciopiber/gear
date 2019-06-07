<?php
namespace Gear\Upgrade\Composer;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Upgrade\Composer\ComposerUpgrade;
use Gear\Module\Structure\ModuleStructure;

class ComposerUpgradeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ComposerUpgrade(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Config\GearConfig'),
            $container->get('Gear\Edge\Composer\ComposerEdge'),
            $container->get('Gear\Util\Prompt\ConsolePrompt'),
            $container->get('Gear\Util\String\StringService')
        );
        
        return $factory;
    }
}
