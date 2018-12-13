<?php
namespace Gear\Integration\Suite\Mvc\MvcSuite;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/Mvc/MvcSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class MvcSuiteFactory implements FactoryInterface
{
    /**
     * Create MvcSuite
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new MvcSuite(
            $serviceLocator->get('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator'),
            $serviceLocator->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
        );
        unset($serviceLocator);
        return $factory;
    }
}
