<?php
namespace Gear\Upgrade\Npm;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Upgrade\Npm\NpmUpgrade;
use Gear\Edge\Npm\NpmEdge;
use Gear\Module\Structure\ModuleStructure;

class NpmUpgradeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new NpmUpgrade(
            $container->get(ModuleStructure::class),
            $container->get('Gear\Config\GearConfig'),
            $container->get(NpmEdge::class),
            $container->get('Gear\Util\Prompt\ConsolePrompt'),
            $container->get('Gear\Util\String\StringService')
        );
        
        return $factory;
    }
}
