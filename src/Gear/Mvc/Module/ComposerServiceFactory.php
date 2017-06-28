<?php
namespace Gear\Mvc\Module;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Module\ComposerService;
use Gear\Gear\Module\BasicModuleStructure;
use Gear\Gear\Edge\ComposerEdge;
use Gear\Gear\Creator\FileCreator;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Mvc/Module
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
            $serviceLocator->get(FileCreator::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
