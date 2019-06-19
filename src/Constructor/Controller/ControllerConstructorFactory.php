<?php
namespace Gear\Constructor\Controller;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Controller\Web\WebControllerService;
use Gear\Mvc\Controller\Web\WebControllerTestService;
use Gear\Table\TableService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Mvc\Controller\Console\{
    ConsoleControllerService,
    ConsoleControllerTestService,
};
use Gear\Mvc\ConsoleController\ConsoleControllerTest;
use Gear\Mvc\Controller\Api\{ApiControllerService, ApiControllerTestService};
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\Config\ControllerManager;
use Gear\Column\ColumnService;
use Gear\Schema\Controller\ControllerSchema;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Constructor/Controller
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerConstructorFactory implements FactoryInterface
{
    /**
     * Create ControllerService
     *
     * @param ServiceLocatorInterface $container ServiceManager instance
     *
     * @return ControllerService
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ControllerConstructor(
            $container->get('Gear\Util\String\StringService'),
            $container->get(ControllerSchema::class),
            $container->get(TableService::class),
            $container->get(ColumnService::class),
            $container->get(ModuleStructure::class),
            $container->get(WebControllerService::class),
            $container->get(WebControllerTestService::class),
            $container->get(ConsoleControllerService::class),
            $container->get(ConsoleControllerTestService::class),
            $container->get(ApiControllerService::class),
            $container->get(ApiControllerTestService::class),
            $container->get(ConfigService::class),
            $container->get(ViewService::class),
            $container->get(LanguageService::class),
            $container->get(ControllerManager::class)
        );

        return $factory;
    }
}
