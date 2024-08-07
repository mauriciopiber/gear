<?php
namespace Gear\Integration\Suite\Src\SrcGenerator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new SrcGenerator(
            $serviceLocator->get('Gear\Integration\Component\GearFile\GearFile'),
            $serviceLocator->get('Gear\Integration\Component\TestFile\TestFile')
        );
        unset($serviceLocator);
        return $factory;
    }
}
