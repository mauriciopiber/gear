<?php
namespace Gear\Mvc\Controller\Api;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Controller\Api\ApiControllerService;
use Gear\Module\Structure\ModuleStructure;
use GearBase\Util\String\StringService;
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
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return ApiControllerService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ApiControllerService(
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get(FileCreator::class),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get(Code::class),
            $serviceLocator->get('Gear\Mvc\Factory\FactoryService'),
            $serviceLocator->get(Injector::class),
            $serviceLocator->get(ArrayService::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
