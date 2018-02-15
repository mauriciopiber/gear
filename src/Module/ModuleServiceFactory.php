<?php
namespace Gear\Module;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\ModuleService;

class ModuleServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ModuleService(
            $serviceLocator->get(FileCreator::class),
            $serviceLocator->get('GearBase\Util\String'),
            $serviceLocator->get('moduleStructure'),
            $serviceLocator->get('Gear\Module\Docs\Docs'),
            $serviceLocator->get('Gear\Module\Composer'),
            $serviceLocator->get('Gear\Module\Tests'),
            $serviceLocator->get('Gear\Module\Node\Karma'),
            $serviceLocator->get('Gear\Module\Node\Protractor'),
            $serviceLocator->get('Gear\Module\Node\Package'),
            $serviceLocator->get('Gear\Module\Node\Gulpfile'),
            $serviceLocator->get('Gear\Mvc\LanguageService'),
            $serviceLocator->get('GearJson\Schema'),
            $serviceLocator->get('GearJson\Schema\Loader'),
            $serviceLocator->get('Gear\Mvc\Config\ConfigService'),
            $serviceLocator->get('Gear\Mvc\View\ViewService'),
            $serviceLocator->get('Request'),
            $serviceLocator->get('cacheService'),
            $serviceLocator->get('Gear\Module\Config\ApplicationConfig'),
            $serviceLocator->get('Gear\Autoload\ComposerAutoload'),
            $serviceLocator->get('config'),
            $serviceLocator->get('GearBase\Util\Dir'),
            $serviceLocator->get('GearBase\GearConfig'),
            $serviceLocator->get('Gear\Module\Constructor\Controller'),
            $serviceLocator->get('Gear\Module\Constructor\Action')
        );
    }
}
