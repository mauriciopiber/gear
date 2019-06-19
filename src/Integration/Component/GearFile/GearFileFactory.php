<?php
namespace Gear\Integration\Component\GearFile;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Integration\Component\GearFile\GearFile;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Component/GearFile
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class GearFileFactory implements FactoryInterface
{
    /**
     * Create GearFile
     *
     * @param ServiceLocatorInterface $container ServiceManager instance
     * @return \Gear\Integration\Component\GearFile\GearFile
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new GearFile(
            $container->get('Gear\Integration\Util\Persist\Persist'),
            $container->get('Gear\Util\String\StringService')
        );

        return $factory;
    }
}
