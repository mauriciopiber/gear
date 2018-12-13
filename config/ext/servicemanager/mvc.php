<?php
use Gear\Mvc;

return [
    'invokables' => [
        /* config */
        Mvc\Config\ConfigService::class                            => Mvc\Config\ConfigService::class,
        /* config manager */
        Mvc\Config\ConsoleRouterManager::class                     => Mvc\Config\ConsoleRouterManager::class,
        Mvc\Config\RouterManager::class                            => Mvc\Config\RouterManager::class,
        Mvc\Config\ServiceManager::class                           => Mvc\Config\ServiceManager::class,
        Mvc\Config\NavigationManager::class                        => Mvc\Config\NavigationManager::class,
        Mvc\Config\ControllerManager::class                        => Mvc\Config\ControllerManager::class,
        Mvc\Config\ViewHelperManager::class                        => Mvc\Config\ViewHelperManager::class,
        Mvc\Config\ControllerPluginManager::class                  => Mvc\Config\ControllerPluginManager::class,
        Mvc\Config\UploadImageManager::class                       => Mvc\Config\UploadImageManager::class,
        Mvc\Config\AssetManager::class                             => Mvc\Config\AssetManager::class,
        Mvc\Controller\Web\WebControllerService::class             => Mvc\Controller\Web\WebControllerService::class,
        Mvc\Controller\Web\WebControllerTestService::class         => Mvc\Controller\Web\WebControllerTestService::class,
        Mvc\ControllerPlugin\ControllerPluginService::class        => Mvc\ControllerPlugin\ControllerPluginService::class,
        Mvc\ControllerPlugin\ControllerPluginTest::class           => Mvc\ControllerPlugin\ControllerPluginTestService::class,
        Mvc\Controller\Console\ConsoleControllerService::class     => Mvc\Controller\Console\ConsoleControllerService::class,
        Mvc\Controller\Console\ConsoleControllerTestService::class => Mvc\Controller\Console\ConsoleControllerTestService::class,

        Mvc\Fixture\FixtureService::class                         => Mvc\Fixture\FixtureService::class,
        Mvc\TraitService::class                                   => Mvc\TraitService::class,
        Mvc\InterfaceService::class                               => Mvc\InterfaceService::class,
        Mvc\View\AngularService::class                            => Mvc\View\AngularService::class,

        Mvc\View\ViewService::class                               => Mvc\View\ViewService::class,
        Mvc\ViewHelper\ViewHelperService::class                   => Mvc\ViewHelper\ViewHelperService::class,
        Mvc\ViewHelper\ViewHelperServiceTest::class               => Mvc\ViewHelper\ViewHelperTestService::class,
        Mvc\View\App\AppControllerService::class                  => Mvc\View\App\AppControllerService::class,
        Mvc\View\App\AppControllerSpecService::class              => Mvc\View\App\AppControllerSpecService::class,
        Mvc\LanguageService::class                                => Mvc\LanguageService::class,
        Mvc\Entity\EntityTestService::class                       => Mvc\Entity\EntityTestService::class,
        Mvc\Entity\DoctrineService::class                         => Mvc\Entity\DoctrineService::class,
        Mvc\Form\FormService::class                               => Mvc\Form\FormService::class,
        Mvc\Form\FormTestService::class                           => Mvc\Form\FormTestService::class,
        Mvc\Search\SearchTestService::class                       => Mvc\Search\SearchTestService::class,
        Mvc\Filter\FilterService::class                           => Mvc\Filter\FilterService::class,
        Mvc\Filter\FilterTestService::class                       => Mvc\Filter\FilterTestService::class,
        Mvc\Factory\FactoryService::class                         => Mvc\Factory\FactoryService::class,
        Mvc\Factory\FactoryTestService::class                     => Mvc\Factory\FactoryTestService::class,
        Mvc\ValueObject\ValueObjectService::class                 => Mvc\ValueObject\ValueObjectService::class,
        Mvc\ControllerPlugin\ControllerPluginService::class       => Mvc\ControllerPlugin\ControllerPluginService::class,
        Mvc\ControllerPlugin\ControllerPluginTestService::class   => Mvc\ControllerPlugin\ControllerPluginTestService::class,
        Mvc\Service\ServiceService::class                         => Mvc\Service\ServiceService::class,
        Mvc\Service\ServiceTestService::class                     => Mvc\Service\ServiceTestService::class,

        Mvc\Repository\RepositoryService::class                   => Mvc\Repository\RepositoryService::class,
        Mvc\Repository\RepositoryTestService::class               => Mvc\Repository\RepositoryTestService::class,
        Mvc\Repository\MappingService::class                      => Mvc\Repository\MappingService::class,
        Mvc\View\ViewService::class                               => Mvc\View\ViewService::class,
        Mvc\Search\SearchService::class                           => Mvc\Search\SearchService::class,
    ***REMOVED***,
    'factories' => [
        Mvc\ValueObject\ValueObjectTestService::class             => Mvc\ValueObject\ValueObjectTestServiceFactory::class,
        Mvc\TraitTestService::class                               => Mvc\TraitTestServiceFactory::class,
        Mvc\Entity\EntityService::class                           => Mvc\Entity\EntityServiceFactory::class,
    ***REMOVED***
***REMOVED***;