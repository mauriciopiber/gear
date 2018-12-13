<?php
namespace Gear\Integration\Util\Persist;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Integration\Util\Persist\Persist;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Util/Persist
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class PersistFactory implements FactoryInterface
{
    /**
     * Create Persist
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Util\Persist\Persist
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Persist(
            $serviceLocator->get('Gear\Integration\Util\Location\Location')
        );
        unset($serviceLocator);
        return $factory;
    }
}
