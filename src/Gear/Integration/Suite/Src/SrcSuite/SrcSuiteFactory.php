<?php
namespace Gear\Integration\Suite\Src\SrcSuite;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuite;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/Src/SrcSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcSuiteFactory implements FactoryInterface
{
    /**
     * Create SrcSuite
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Suite\Src\SrcSuite\SrcSuite
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new SrcSuite(
            $serviceLocator->get('Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator'),
            $serviceLocator->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
        );
        unset($serviceLocator);
        return $factory;
    }
}
