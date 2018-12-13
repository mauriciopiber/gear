<?php
namespace Gear\Integration\Util\ResolveNames;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ResolveNames(
            $serviceLocator->get('Gear\Util\String\StringService')
        );
        unset($serviceLocator);
        return $factory;
    }
}
