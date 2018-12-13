<?php
namespace Gear\Integration\Suite\Controller\ControllerSuite;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/Controller/ControllerSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerSuiteFactory implements FactoryInterface
{
    /**
     * Create ControllerSuite
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ControllerSuite(
            $serviceLocator->get('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator'),
            $serviceLocator->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
        );
        unset($serviceLocator);
        return $factory;
    }
}
