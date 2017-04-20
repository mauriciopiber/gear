<?php
namespace Gear\Mvc\ValueObject;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\ValueObject\ValueObjectTestService;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Mvc/ValueObject
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ValueObjectTestServiceFactory implements FactoryInterface
{
    /**
     * Create ValueObjectTestService
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Mvc\ValueObject\ValueObjectTestService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ValueObjectTestService(
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('Gear\FileCreator'),
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('Gear\Creator\CodeTest')
        );
        unset($serviceLocator);
        return $factory;
    }
}
