<?php
namespace Gear\Project;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Project\ProjectService;
use Gear\Creator\FileCreator\FileCreator;

class ProjectServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $projectService = new ProjectService(
            $serviceLocator->get('Gear\Config\GearConfig'),
            $serviceLocator->get('Gear\Util\Dir\DirService'),
            $serviceLocator->get('Gear\Util\File\FileService'),
            $serviceLocator->get(FileCreator::class),
            $serviceLocator->get('Gear\Edge\Dir\DirEdge'),
            $serviceLocator->get('Gear\Project\Docs\Docs'),
            $serviceLocator->get('Gear\Util\Prompt\ConsolePrompt'),
            $serviceLocator->get('Gear\Upgrade\Ant\AntUpgrade'),
            $serviceLocator->get('Gear\Upgrade\Npm\NpmUpgrade'),
            $serviceLocator->get('config'),
            $serviceLocator->get('Gear\Project\Composer\ComposerService')
            //$serviceLocator->get('config'),
            //$serviceLocator->get('Gear\Util\String\StringService'),
            //$serviceLocator->get(FileCreator::class)
        );
        unset($serviceLocator);
        return $projectService;
    }
}
