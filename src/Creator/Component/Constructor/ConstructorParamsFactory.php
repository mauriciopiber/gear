<?php
namespace Gear\Creator\Component\Constructor;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Creator\Component\Constructor\ConstructorParams;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Creator/Component/Constructor
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ConstructorParamsFactory implements FactoryInterface
{
    /**
     * Create ConstructorParams
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Creator\Component\Constructor\ConstructorParams
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ConstructorParams(
            $serviceLocator->get('GearBase\Util\String')
        );
        unset($serviceLocator);
        return $factory;
    }
}
