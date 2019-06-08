<?php
namespace Gear\Module\Tests;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Module\Tests\ModuleTestsService;
use Gear\Upgrade\Ant\AntUpgrade;
use Gear\Util\String\StringService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;

/**
 * PHP Version 5
 *
 * @category Module
 * @package Gear
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://piber.network
 */
class ModuleTestsServiceFactory implements FactoryInterface
{
    /**
     * Create ModuleService
     *
     * @param ContainerInterface $container Container
     *
     * @return ModuleService
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName = null,
        $options = [***REMOVED***
    ) {
        $factory = new ModuleTestsService(
            $container->get(ModuleStructure::class),
            $container->get(FileCreator::class),
            $container->get(StringService::class),
            $container->get(AntUpgrade::class)
        );
        return $factory;
    }
}
