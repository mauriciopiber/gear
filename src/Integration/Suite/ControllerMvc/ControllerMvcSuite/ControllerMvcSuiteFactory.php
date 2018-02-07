<?php
namespace Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/ControllerMvc/ControllerMvcSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerMvcSuiteFactory implements FactoryInterface
{
    /**
     * Create ControllerMvcSuite
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ControllerMvcSuite(
            $serviceLocator->get('Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator'),
            $serviceLocator->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
        );
        unset($serviceLocator);
        return $factory;
    }
}
