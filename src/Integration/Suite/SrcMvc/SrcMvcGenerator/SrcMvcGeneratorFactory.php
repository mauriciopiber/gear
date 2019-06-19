<?php
namespace Gear\Integration\Suite\SrcMvc\SrcMvcGenerator;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
     * @param ServiceLocatorInterface $container ServiceManager instance
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new SrcMvcGenerator(
            $container->get('Gear\Integration\Component\GearFile\GearFile'),
            $container->get('Gear\Integration\Component\TestFile\TestFile'),
            $container->get('Gear\Integration\Component\MigrationFile\MigrationFile'),
            $container->get('Gear\Integration\Util\ResolveNames\ResolveNames'),
            $container->get('Gear\Integration\Util\Columns\Columns')
        );

        return $factory;
    }
}
