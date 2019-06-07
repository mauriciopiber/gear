<?php
namespace Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/ControllerMvc/ControllerMvcGenerator
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerMvcGeneratorFactory implements FactoryInterface
{
    /**
     * Create ControllerMvcGenerator
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ControllerMvcGenerator(
            $container->get('Gear\Integration\Component\GearFile\GearFile'),
            $container->get('Gear\Integration\Component\TestFile\TestFile'),
            $container->get('Gear\Integration\Util\ResolveNames\ResolveNames'),
            $container->get('Gear\Integration\Util\Columns\Columns')
        );
        
        return $factory;
    }
}
