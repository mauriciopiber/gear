<?php
namespace Gear\Integration\Util\ResolveNames;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Integration\Util\ResolveNames\ResolveNames;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Util/ResolveNames
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ResolveNamesFactory implements FactoryInterface
{
    /**
     * Create ResolveNames
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Util\ResolveNames\ResolveNames
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ResolveNames(
            $container->get('Gear\Util\String\StringService')
        );
        
        return $factory;
    }
}
