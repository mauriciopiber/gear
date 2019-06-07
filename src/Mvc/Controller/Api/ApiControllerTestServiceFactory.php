<?php
namespace Gear\Mvc\Controller\Api;

use Gear\Creator\Injector\Injector;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Controller\Api\ApiControllerTestService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Creator\CodeTest;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Mvc\Config\ControllerManager;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Mvc/Controller/Api
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ApiControllerTestServiceFactory implements FactoryInterface
{
    /**
     * Create ApiControllerTestService
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return ApiControllerTestService
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ApiControllerTestService(
            $container->get(ModuleStructure::class),
            $container->get(FileCreator::class),
            $container->get('Gear\Util\String\StringService'),
            $container->get(CodeTest::class),
            $container->get('Gear\Mvc\Factory\FactoryTestService'),
            $container->get(ControllerManager::class),
            $container->get(Injector::class)
        );
        
        return $factory;
    }
}
