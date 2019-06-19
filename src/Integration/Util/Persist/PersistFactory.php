<?php
namespace Gear\Integration\Util\Persist;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
     * @param ServiceLocatorInterface $container ServiceManager instance
     * @return \Gear\Integration\Util\Persist\Persist
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new Persist(
            $container->get('Gear\Integration\Util\Location\Location')
        );

        return $factory;
    }
}
