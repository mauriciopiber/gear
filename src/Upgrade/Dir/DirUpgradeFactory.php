<?php
namespace Gear\Upgrade\Dir;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Upgrade\Dir\DirUpgrade;
use Gear\Edge\Dir\DirEdge;
use Gear\Module\Structure\ModuleStructure;

class DirUpgradeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new DirUpgrade(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Config\GearConfig'),
            $container->get(DirEdge::class),
            $container->get('Gear\Util\Prompt\ConsolePrompt'),
            $container->get('Gear\Util\Dir\DirService')
        );
        
        return $factory;
    }
}
