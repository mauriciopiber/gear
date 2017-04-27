<?php
namespace Gear\Integration\Suite\SrcMvc\SrcMvcSuite;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/SrcMvc/SrcMvcSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcMvcSuiteFactory implements FactoryInterface
{
    /**
     * Create SrcMvcSuite
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new SrcMvcSuite(
            $serviceLocator->get('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator'),
            $serviceLocator->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
        );
        unset($serviceLocator);
        return $factory;
    }
}
