<?php
namespace Gear\Integration\Component\TestFile;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Integration\Component\TestFile\TestFile;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Component/TestFile
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class TestFileFactory implements FactoryInterface
{
    /**
     * Create TestFile
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Component\TestFile\TestFile
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new TestFile(
            $serviceLocator->get('Gear\Integration\Util\Persist\Persist'),
            $serviceLocator->get('Gear\Util\String\StringService')
        );
        unset($serviceLocator);
        return $factory;
    }
}
