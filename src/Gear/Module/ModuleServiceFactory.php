<?php
namespace Gear\Module;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Gear\Module\ModuleService(
            $serviceLocator->get('Gear\FileCreator'),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('Gear\Module\Docs\Docs'),
            $serviceLocator->get('Gear\Module\Composer'),
            $serviceLocator->get('Gear\Module\Codeception'),
            $serviceLocator->get('Gear\Module\Test'),
            $serviceLocator->get('Gear\Module\Node\Karma'),
            $serviceLocator->get('Gear\Module\Node\Protractor'),
            $serviceLocator->get('Gear\Module\Node\Package'),
            $serviceLocator->get('Gear\Module\Node\Gulpfile'),
            $serviceLocator->get('Gear\Mvc\LanguageService'),
            $serviceLocator->get('GearJson\Schema'),
            $serviceLocator->get('GearJson\Schema\Loader'),
            $serviceLocator->get('GearJson\Controller'),
            $serviceLocator->get('GearJson\Action'),
            $serviceLocator->get('Gear\Mvc\Config\ConfigService'),
            $serviceLocator->get('Gear\Mvc\Controller\Controller'),
            $serviceLocator->get('Gear\Mvc\Controller\ControllerTest'),
            $serviceLocator->get('Gear\Mvc\ConsoleController\ConsoleController'),
            $serviceLocator->get('Gear\Mvc\ConsoleController\ConsoleControllerTest'),
            $serviceLocator->get('Gear\Mvc\View\ViewService'),
            $serviceLocator->get('Gear\Mvc\View\App\AppControllerService'),
            $serviceLocator->get('Gear\Mvc\View\App\AppControllerSpecService'),
            $serviceLocator->get('Gear\Mvc\Spec\Feature\Feature'),
            $serviceLocator->get('Gear\Mvc\Spec\Step\Step'),
            $serviceLocator->get('Gear\Mvc\Spec\Page\Page'),
            $serviceLocator->get('Gear\Mvc\Spec\UnitTest\UnitTest'),
            $serviceLocator->get('Request'),
            $serviceLocator->get('cacheService'),
            $serviceLocator->get('Gear\Module\Config\ApplicationConfig'),
            $serviceLocator->get('Gear\Autoload\ComposerAutoload'),
            $serviceLocator->get('config'),
            $serviceLocator->get('GearBase\Util\Dir'),
            $serviceLocator->get('GearBase\GearConfig')
        );
    }
}
