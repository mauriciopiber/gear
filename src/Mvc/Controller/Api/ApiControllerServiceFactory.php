<?php
namespace Gear\Mvc\Controller\Api;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Controller\Api\ApiControllerService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Creator\Code;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\Injector\Injector;
use Gear\Util\Vector\ArrayService;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Mvc/Controller/Api
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ApiControllerServiceFactory implements FactoryInterface
{
    /**
     * Create ApiControllerService
     *
     * @param ServiceLocatorInterface $container ServiceManager instance
     *
     * @return ApiControllerService
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ApiControllerService(
            $container->get(ModuleStructure::class),
            $container->get(FileCreator::class),
            $container->get('Gear\Util\String\StringService'),
            $container->get(Code::class),
            $container->get('Gear\Mvc\Factory\FactoryService'),
            $container->get(Injector::class),
            $container->get(ArrayService::class)
        );

        return $factory;
    }
}
