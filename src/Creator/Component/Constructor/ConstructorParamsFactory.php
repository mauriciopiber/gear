<?php
namespace Gear\Creator\Component\Constructor;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ConstructorParams(
            $container->get('Gear\Util\String\StringService')
        );
        
        return $factory;
    }
}
