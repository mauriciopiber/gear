<?php
namespace Gear\Kube;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Kube\KubeService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\String\StringService;
use Gear\Code\Code;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Kube
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class KubeServiceFactory implements FactoryInterface
{
    /**
     * Create KubeService
     *
     * @param ContainerInterface $container ServiceManager instance
     *
     * @return KubeService
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new KubeService(
            $container->get(ModuleStructure::class),
            $container->get(FileCreator::class),
            $container->get(StringService::class),
            $container->get(Code::class)
        );

        return $factory;
    }
}
