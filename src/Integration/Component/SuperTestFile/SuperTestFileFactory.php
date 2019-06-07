<?php
namespace Gear\Integration\Component\SuperTestFile;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Component/SuperTestFile
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SuperTestFileFactory implements FactoryInterface
{
    /**
     * Create SuperTestFile
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Component\SuperTestFile\SuperTestFile
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new SuperTestFile(
            $container->get('Gear\Integration\Util\Persist\Persist'),
            $container->get('Gear\Util\String\StringService')
        );
        
        return $factory;
    }
}
