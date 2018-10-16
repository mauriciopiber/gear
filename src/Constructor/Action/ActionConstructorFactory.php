<?php
namespace Gear\Constructor\Action;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ActionConstructor(
            $serviceLocator->get('GearJson\Action'),
            //$serviceLocator->get(ConfigService::class),
            $serviceLocator->get(RouterManager::class),
            $serviceLocator->get(ConsoleRouterManager::class),
            $serviceLocator->get(NavigationManager::class),
            $serviceLocator->get(ViewService::class),
            $serviceLocator->get(WebControllerService::class),
            $serviceLocator->get(WebControllerTestService::class),
            $serviceLocator->get(ConsoleControllerService::class),
            $serviceLocator->get(ConsoleControllerTestService::class),
            $serviceLocator->get(ApiControllerService::class),
            $serviceLocator->get(ApiControllerTestService::class),
            $serviceLocator->get(AppControllerService::class),
            $serviceLocator->get(AppControllerSpecService::class),
            $serviceLocator->get(Feature::class),
            $serviceLocator->get(Page::class),
            $serviceLocator->get(Step::class),
            $serviceLocator->get(ModuleStructure::class),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get(TableService::class),
            $serviceLocator->get(ColumnService::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
