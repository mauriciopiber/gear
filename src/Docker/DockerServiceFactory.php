<?php
namespace Gear\Docker;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new DockerService(
            $container->get('Gear\Util\String\StringService'),
            $container->get(FileCreator::class),
            $container->get(ModuleStructure::class)
        );
        
        return $factory;
    }

    public function createDockerComposeFile()
    {
      return true;
    }
}
