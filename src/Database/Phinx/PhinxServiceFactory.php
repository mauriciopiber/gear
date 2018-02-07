<?php
namespace Gear\Database\Phinx;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Database\Phinx\PhinxService;
use Gear\Creator\FileCreator\FileCreator;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Database/Phinx
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class PhinxServiceFactory implements FactoryInterface
{
    /**
     * Create PhinxService
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Database\Phinx\PhinxService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new PhinxService(
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get(FileCreator::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
