<?php
namespace Gear\Integration\Suite\Mvc\MvcGenerator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new MvcGenerator(
            $serviceLocator->get('Gear\Integration\Component\GearFile\GearFile'),
            $serviceLocator->get('Gear\Integration\Component\TestFile\TestFile'),
            $serviceLocator->get('Gear\Integration\Component\MigrationFile\MigrationFile'),
            $serviceLocator->get('Gear\Integration\Util\ResolveNames\ResolveNames'),
            $serviceLocator->get('Gear\Integration\Util\Columns\Columns')
        );
        unset($serviceLocator);
        return $factory;
    }
}
