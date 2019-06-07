<?php
namespace Gear\Integration\Suite\SrcMvc\SrcMvcSuite;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new SrcMvcSuite(
            $container->get('Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator'),
            $container->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
        );
        
        return $factory;
    }
}
