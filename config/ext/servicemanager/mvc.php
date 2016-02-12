<?php
return [
    'invokables' => [
        /* config */
        'configService'                                          => 'Gear\Mvc\Config\ConfigService',

        /* config manager */
        'Gear\Mvc\Config\ConsoleRouter'                          => 'Gear\Mvc\Config\ConsoleRouterManager',
        'Gear\Mvc\Config\Router'                                 => 'Gear\Mvc\Config\RouterManager',
        'Gear\Mvc\Config\ServiceManager'                         => 'Gear\Mvc\Config\ServiceManager',
        'Gear\Mvc\Config\Navigation'                             => 'Gear\Mvc\Config\NavigationManager',
        'Gear\Mvc\Config\Controller'                             => 'Gear\Mvc\Config\ControllerManager',
        'Gear\Mvc\Config\ViewHelperManager'                      => 'Gear\Mvc\Config\ViewHelperManager',
        'Gear\Mvc\Config\ControllerPluginManager'                => 'Gear\Mvc\Config\ControllerPluginManager',
        'Gear\Mvc\Config\UploadImage'                            => 'Gear\Mvc\Config\UploadImageManager',
        'Gear\Mvc\Config\AssetManager'                           => 'Gear\Mvc\Config\AssetManager',

        'controllerService'                                      => 'Gear\Mvc\Controller\ControllerService',
        'controllerTestService'                                  => 'Gear\Mvc\Controller\ControllerTestService',
        'Gear\Mvc\ControllerPlugin\ControllerPlugin'             => 'Gear\Mvc\ControllerPlugin\ControllerPluginService',
        'Gear\Mvc\ControllerPlugin\ControllerPluginTest'         => 'Gear\Mvc\ControllerPlugin\ControllerPluginTestService',

        'Gear\Mvc\ConsoleController\ConsoleController'           => 'Gear\Mvc\ConsoleController\ConsoleController',
        'Gear\Mvc\ConsoleController\ConsoleControllerTest'       => 'Gear\Mvc\ConsoleController\ConsoleControllerTest',
        'Gear\Mvc\ConsoleController\ConsoleControllerAction'     => 'Gear\Mvc\ConsoleController\ConsoleControllerAction',
        'Gear\Mvc\ConsoleController\ConsoleControllerActionTest' => 'Gear\Mvc\ConsoleController\ConsoleControllerActionTest',
        'Gear\Mvc\Fixture\FixtureService'                        => 'Gear\Mvc\Fixture\FixtureService',
        'Gear\Mvc\Trait'                                         => 'Gear\Mvc\TraitService',
        'Gear\Mvc\Interface'                                     => 'Gear\Mvc\InterfaceService',
        'Gear\Mvc\TestService'                                   => 'Gear\Mvc\TestService',

        'Gear\Mvc\ViewService'                                   => 'Gear\Mvc\ViewService',


        'Gear\Mvc\View\AngularService'                           => 'Gear\Mvc\View\AngularService',

        'Gear\Mvc\View\ViewService'                              => 'Gear\Mvc\View\ViewService',
        'Gear\Mvc\ViewHelper\ViewHelper'                         => 'Gear\Mvc\ViewHelper\ViewHelperService',
        'Gear\Mvc\ViewHelper\ViewHelperTest'                     => 'Gear\Mvc\ViewHelper\ViewHelperTestService',


        'languageService'                                        => 'Gear\Mvc\LanguageService',
        'entityService'                                          => 'Gear\Mvc\Entity\EntityService',
        'entityTestService'                                      => 'Gear\Mvc\Entity\EntityTestService',
        'doctrineService'                                        => 'Gear\Mvc\Entity\DoctrineService',
        'formService'                                            => 'Gear\Mvc\Form\FormService',
        'formTestService'                                        => 'Gear\Mvc\Form\FormTestService',
        'searchTestService'                                      => 'Gear\Mvc\Search\SearchTestService',
        'filterService'                                          => 'Gear\Mvc\Filter\FilterService',
        'filterTestService'                                      => 'Gear\Mvc\Filter\FilterTestService',
        'factoryService'                                         => 'Gear\Mvc\Factory\FactoryService',
        'factoryTestService'                                     => 'Gear\Mvc\Factory\FactoryTestService',
        'valueObjectService'                                     => 'Gear\Mvc\ValueObject\ValueObjectService',
        'valueObjectTestService'                                 => 'Gear\Mvc\ValueObject\ValueObjectTestService',
        'controllerPluginService'                                => 'Gear\Mvc\ControllerPlugin\ControllerPluginService',
        'controllerPluginTestService'                            => 'Gear\Mvc\ControllerPlugin\ControllerPluginTestService',
        'serviceService'                                         => 'Gear\Mvc\Service\ServiceService',
        'serviceTestService'                                     => 'Gear\Mvc\Service\ServiceTestService',
        'repositoryService'                                      => 'Gear\Mvc\Repository\RepositoryService',
        'repositoryTestService'                                  => 'Gear\Mvc\Repository\RepositoryTestService',
        'RepositoryService\MappingService'                       => 'Gear\Mvc\Repository\MappingService',
        'viewService'                                            => 'Gear\Service\Mvc\ViewService',
        'ViewService\TableService'                               => 'Gear\Service\Mvc\ViewService\TableService',
        'ViewService\FormService'                                => 'Gear\Service\Mvc\ViewService\FormService',
        'ViewService\SearchService'                              => 'Gear\Service\Mvc\ViewService\SearchService',
        'zendServiceLocatorService'                              => 'Gear\Service\Test\ZendServiceLocatorService',
        'Gear\Mvc\Search\SearchService'                          => 'Gear\Mvc\Search\SearchService',
    ***REMOVED***
***REMOVED***;