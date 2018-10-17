<?php
namespace Gear\Docker;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Docker\DockerService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Docker
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class DockerServiceFactory implements FactoryInterface
{
    /**
     * Create DockerService
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return DockerService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new DockerService(
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get(FileCreator::class),
            $serviceLocator->get(ModuleStructure::class)
        );
        unset($serviceLocator);
        return $factory;
    }

    public function createDockerComposeFile()
    {
      return true;
    }
}
