<?php
namespace Gear\Integration\Component\TestFile;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
     * @param ServiceLocatorInterface $container ServiceManager instance
     * @return \Gear\Integration\Component\TestFile\TestFile
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new TestFile(
            $container->get('Gear\Integration\Util\Persist\Persist'),
            $container->get('Gear\Util\String\StringService')
        );

        return $factory;
    }
}
