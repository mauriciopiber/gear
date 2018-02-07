<?php
namespace Gear\Integration\Suite\SrcMvc\SrcMvcGenerator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/SrcMvc/SrcMvcGenerator
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcMvcGeneratorFactory implements FactoryInterface
{
    /**
     * Create SrcMvcGenerator
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new SrcMvcGenerator(
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
