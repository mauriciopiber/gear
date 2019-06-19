<?php
namespace Gear\Integration\Suite\Src\SrcGenerator;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/Src/SrcGenerator
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcGeneratorFactory implements FactoryInterface
{
    /**
     * Create SrcGenerator
     *
     * @param ServiceLocatorInterface $container ServiceManager instance
     * @return \Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new SrcGenerator(
            $container->get('Gear\Integration\Component\GearFile\GearFile'),
            $container->get('Gear\Integration\Component\TestFile\TestFile')
        );

        return $factory;
    }
}
