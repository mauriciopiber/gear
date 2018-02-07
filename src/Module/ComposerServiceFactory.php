<?php
namespace Gear\Module;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Module\ComposerService;
use Gear\Module\BasicModuleStructure;
use Gear\Edge\ComposerEdge;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\Vector\ArrayService;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Module
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ComposerServiceFactory implements FactoryInterface
{
    /**
     * Create ComposerService
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return ComposerService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ComposerService(
            $serviceLocator->get(BasicModuleStructure::class),
            $serviceLocator->get(ComposerEdge::class),
            $serviceLocator->get(FileCreator::class),
            $serviceLocator->get(ArrayService::class),
            $serviceLocator->get('GearBase\Util\String')
        );
        unset($serviceLocator);
        return $factory;
    }
}
