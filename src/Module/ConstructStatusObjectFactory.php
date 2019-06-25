<?php
namespace Gear\Module;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Module\ConstructStatusObject;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Module
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ConstructStatusObjectFactory implements FactoryInterface
{
    /**
     * Create ConstructStatusObject
     *
     * @param ContainerInterface $container ServiceManager instance
     *
     * @return ConstructStatusObject
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new ConstructStatusObject(
            $container->get('console')
        );

        return $factory;
    }
}
