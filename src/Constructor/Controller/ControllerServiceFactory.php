<?php
namespace Gear\Constructor\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Controller\Web\WebControllerService;
use Gear\Mvc\Controller\Web\WebControllerTestService;
use Gear\Table\TableService;
use Gear\Module\BasicModuleStructure;
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

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Constructor/Controller
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerServiceFactory implements FactoryInterface
{
    /**
     * Create ControllerService
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return ControllerService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ControllerService(
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('GearJson\Controller'),
            $serviceLocator->get(TableService::class),
            $serviceLocator->get(ColumnService::class),
            $serviceLocator->get(BasicModuleStructure::class),
            $serviceLocator->get(WebControllerService::class),
            $serviceLocator->get(WebControllerTestService::class),
            $serviceLocator->get(ConsoleControllerService::class),
            $serviceLocator->get(ConsoleControllerTestService::class),
            $serviceLocator->get(ApiControllerService::class),
            $serviceLocator->get(ApiControllerTestService::class),
            $serviceLocator->get(ConfigService::class),
            $serviceLocator->get(ViewService::class),
            $serviceLocator->get(LanguageService::class),
            $serviceLocator->get(ControllerManager::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
