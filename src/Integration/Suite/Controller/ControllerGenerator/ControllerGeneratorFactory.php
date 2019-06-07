<?php
namespace Gear\Integration\Suite\Controller\ControllerGenerator;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/Controller/ControllerGenerator
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerGeneratorFactory implements FactoryInterface
{
    /**
     * Create ControllerGenerator
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ControllerGenerator(
            $container->get('Gear\Integration\Component\GearFile\GearFile'),
            $container->get('Gear\Integration\Component\TestFile\TestFile')
        );
        
        return $factory;
    }
}
