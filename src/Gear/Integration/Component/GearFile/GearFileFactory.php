<?php
namespace Gear\Integration\Component\GearFile;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Component\GearFile\GearFile
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new GearFile(
            $serviceLocator->get('Gear\Integration\Util\Persist\Persist'),
            $serviceLocator->get('GearBase\Util\String')
        );
        unset($serviceLocator);
        return $factory;
    }
}
