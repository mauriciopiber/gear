<?php
namespace Gear\Upgrade\Ant;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Upgrade\Ant\AntUpgrade;
use Gear\Edge\Ant\AntEdge;
use Gear\Module\Structure\ModuleStructure;

class AntUpgradeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new AntUpgrade(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Config\GearConfig'),
            $container->get(AntEdge::class),
            $container->get('Gear\Util\Prompt\ConsolePrompt'),
            $container->get('Gear\Util\String\StringService')
        );
        
        return $factory;
    }
}
