<?php
namespace Gear\Integration\Suite\Controller\ControllerSuite;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
     * @param ServiceLocatorInterface $container ServiceManager instance
     * @return \Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ControllerSuite(
            $container->get('Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator'),
            $container->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
        );

        return $factory;
    }
}
