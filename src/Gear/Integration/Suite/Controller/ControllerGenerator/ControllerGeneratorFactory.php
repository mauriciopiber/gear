<?php
namespace Gear\Integration\Suite\Controller\ControllerGenerator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ControllerGenerator(
            $serviceLocator->get('Gear\Integration\Component\GearFile\GearFile'),
            $serviceLocator->get('Gear\Integration\Component\TestFile\TestFile')
        );
        unset($serviceLocator);
        return $factory;
    }
}
