<?php
namespace Gear\Integration\Suite\Integration;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Integration\Suite\Integration\Integration;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/Integration
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class IntegrationFactory implements FactoryInterface
{
    /**
     * Create Integration
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\Integration\Integration
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Integration(
            $serviceLocator->get('Gear\Integration\Suite\Src\SrcSuite\SrcSuite'),
            $serviceLocator->get('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite'),
            $serviceLocator->get('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite'),
            $serviceLocator->get('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite'),
            $serviceLocator->get('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite')
        );
        unset($serviceLocator);
        return $factory;
    }
}
