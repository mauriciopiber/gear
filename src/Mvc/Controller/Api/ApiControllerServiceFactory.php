<?php
namespace Gear\Mvc\Controller\Api;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Controller\Api\ApiControllerService;

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
        );
        unset($serviceLocator);
        return $factory;
    }
}
