<?php
namespace Gear\Project;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Project\ProjectService;
use Gear\Creator\FileCreator\FileCreator;

class ProjectServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $projectService = new ProjectService(
            $container->get('Gear\Config\GearConfig'),
            $container->get('Gear\Util\Dir\DirService'),
            $container->get('Gear\Util\File\FileService'),
            $container->get(FileCreator::class),
            $container->get('Gear\Edge\Dir\DirEdge'),
            $container->get('Gear\Project\Docs\Docs'),
            $container->get('Gear\Util\Prompt\ConsolePrompt'),
            $container->get('Gear\Upgrade\Ant\AntUpgrade'),
            $container->get('Gear\Upgrade\Npm\NpmUpgrade'),
            $container->get('config'),
            $container->get('Gear\Project\Composer\ComposerService')
            //$container->get('config'),
            //$container->get('Gear\Util\String\StringService'),
            //$container->get(FileCreator::class)
        );
        
        return $projectService;
    }
}
