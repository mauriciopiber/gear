<?php
namespace Gear\Integration\Suite\Integration;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
     * @param ServiceLocatorInterface $container ServiceManager instance
     * @return \Gear\Integration\Suite\Integration\Integration
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new Integration(
            $container->get('Gear\Integration\Suite\Src\SrcSuite\SrcSuite'),
            $container->get('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite'),
            $container->get('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite'),
            $container->get('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite'),
            $container->get('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite')
        );

        return $factory;
    }
}
