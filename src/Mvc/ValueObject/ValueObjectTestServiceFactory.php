<?php
namespace Gear\Mvc\ValueObject;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\ValueObject\ValueObjectTestService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;

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
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ValueObjectTestService(
            $container->get('Gear\Util\String\StringService'),
            $container->get(FileCreator::class),
            $container->get(ModuleStructure::class),
            $container->get('Gear\Creator\CodeTest')
        );
        
        return $factory;
    }
}
