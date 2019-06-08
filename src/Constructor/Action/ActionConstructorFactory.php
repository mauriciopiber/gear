<?php
namespace Gear\Constructor\Action;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Constructor\Action\ActionConstructor;
use Gear\Mvc\Config\RouterManager;
use Gear\Mvc\Config\ConsoleRouterManager;
use Gear\Mvc\Config\NavigationManager;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\Controller\Web\WebControllerService;
use Gear\Mvc\Controller\Web\WebControllerTestService;
use Gear\Mvc\Controller\Console\{
    ConsoleControllerService,
    ConsoleControllerTestService,
};
use Gear\Mvc\View\App\AppControllerService;
use Gear\Mvc\View\App\AppControllerSpecService;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Mvc\Spec\Page\Page;
use Gear\Mvc\Spec\Step\Step;
use Gear\Module\Structure\ModuleStructure;
use Gear\Column\ColumnService;
use Gear\Table\TableService;
use Gear\Mvc\Controller\Api\{
    ApiControllerService,
    ApiControllerTestService,
};
use Gear\Schema\Action\ActionSchema;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Constructor/Action
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ActionConstructorFactory implements FactoryInterface
{
    /**
     * Create ActionConstructor
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return ActionConstructor
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new ActionConstructor(
            $container->get(ActionSchema::class),
            //$container->get(ConfigService::class),
            $container->get(RouterManager::class),
            $container->get(ConsoleRouterManager::class),
            $container->get(NavigationManager::class),
            $container->get(ViewService::class),
            $container->get(WebControllerService::class),
            $container->get(WebControllerTestService::class),
            $container->get(ConsoleControllerService::class),
            $container->get(ConsoleControllerTestService::class),
            $container->get(ApiControllerService::class),
            $container->get(ApiControllerTestService::class),
            $container->get(Feature::class),
            $container->get(Page::class),
            $container->get(Step::class),
            $container->get(ModuleStructure::class),
            $container->get('Gear\Util\String\StringService'),
            $container->get(TableService::class),
            $container->get(ColumnService::class)
        );

        return $factory;
    }
}
