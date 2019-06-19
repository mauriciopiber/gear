<?php
namespace Gear\Module;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Module\ComposerService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Edge\Composer\ComposerEdge;
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
     * @param ServiceLocatorInterface $container ServiceManager instance
     *
     * @return ComposerService
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ComposerService(
            $container->get(ModuleStructure::class),
            $container->get(ComposerEdge::class),
            $container->get(FileCreator::class),
            $container->get(ArrayService::class),
            $container->get('Gear\Util\String\StringService')
        );

        return $factory;
    }
}
