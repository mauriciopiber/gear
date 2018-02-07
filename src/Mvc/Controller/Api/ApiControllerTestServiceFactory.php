<?php
namespace Gear\Mvc\Controller\Api;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Controller\Api\ApiControllerTestService;

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
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ApiControllerTestService(
        );
        unset($serviceLocator);
        return $factory;
    }
}
