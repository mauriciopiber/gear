<?php
namespace Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ControllerMvcGenerator(
            $serviceLocator->get('Gear\Integration\Component\GearFile\GearFile'),
            $serviceLocator->get('Gear\Integration\Component\TestFile\TestFile'),
            $serviceLocator->get('Gear\Integration\Util\ResolveNames\ResolveNames'),
            $serviceLocator->get('Gear\Integration\Util\Columns\Columns')
        );
        unset($serviceLocator);
        return $factory;
    }
}
