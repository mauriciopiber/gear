<?php
namespace Gear\Integration\Suite\Mvc\MvcGenerator;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/Mvc/MvcGenerator
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class MvcGeneratorFactory implements FactoryInterface
{
    /**
     * Create MvcGenerator
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new MvcGenerator(
            $container->get('Gear\Integration\Component\GearFile\GearFile'),
            $container->get('Gear\Integration\Component\TestFile\TestFile'),
            $container->get('Gear\Integration\Component\MigrationFile\MigrationFile'),
            $container->get('Gear\Integration\Util\ResolveNames\ResolveNames'),
            $container->get('Gear\Integration\Util\Columns\Columns')
        );
        
        return $factory;
    }
}
