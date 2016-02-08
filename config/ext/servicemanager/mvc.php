<?php
return [
    'invokables' => [
        'configService'                        => 'Gear\Mvc\Config\ConfigService',
        'Gear\Mvc\Config\Router'               => 'Gear\Mvc\Config\Router',
        'Gear\Mvc\Config\ServiceManager'       => 'Gear\Mvc\Config\ServiceManager',
        'Gear\Mvc\Config\Navigation'           => 'Gear\Mvc\Config\Navigation',
        'Gear\Mvc\Config\Controller'           => 'Gear\Mvc\Config\Controller',
        'Gear\Mvc\Config\UploadImage'          => 'Gear\Mvc\Config\UploadImage',

        'controllerService'                    => 'Gear\Mvc\Controller\ControllerService',
        'controllerTestService'                => 'Gear\Mvc\Controller\ControllerTestService',
        'Gear\Mvc\Controller\Controller'       => 'Gear\Mvc\Controller\Controller',
        'Gear\Mvc\Controller\ControllerTest'   => 'Gear\Mvc\Controller\ControllerTest',
        'Gear\Mvc\Controller\ControllerConfig' => 'Gear\Mvc\Controller\ControllerConfig',
        'Gear\Mvc\Fixture\FixtureService'      => 'Gear\Mvc\Fixture\FixtureService',



        'Gear\Mvc\TestService'                 => 'Gear\Mvc\TestService',
        'Gear\Mvc\ViewService'                 => 'Gear\Mvc\ViewService',
        'Gear\Mvc\View\AngularService'         => 'Gear\Mvc\View\AngularService',
        'Gear\Mvc\View\ViewService'            => 'Gear\Mvc\View\ViewService',
        'languageService'                      => 'Gear\Mvc\LanguageService',
        'entityService'                        => 'Gear\Mvc\Entity\EntityService',
        'entityTestService'                    => 'Gear\Mvc\Entity\EntityTestService',
        'doctrineService'                      => 'Gear\Mvc\Entity\DoctrineService',

        'formService'                          => 'Gear\Mvc\Form\FormService',
        'formTestService'                      => 'Gear\Mvc\Form\FormTestService',
        'searchTestService'                    => 'Gear\Mvc\Search\SearchTestService',
        'filterService'                        => 'Gear\Mvc\Filter\FilterService',
        'filterTestService'                    => 'Gear\Mvc\Filter\FilterTestService',
        'factoryService'                       => 'Gear\Mvc\Factory\FactoryService',
        'factoryTestService'                   => 'Gear\Mvc\Factory\FactoryTestService',
        'valueObjectService'                   => 'Gear\Mvc\ValueObject\ValueObjectService',
        'valueObjectTestService'               => 'Gear\Mvc\ValueObject\ValueObjectTestService',
        'controllerPluginService'              => 'Gear\Mvc\ControllerPlugin\ControllerPluginService',
        'controllerPluginTestService'          => 'Gear\Mvc\ControllerPlugin\ControllerPluginTestService',
        'serviceService'                       => 'Gear\Mvc\Service\ServiceService',
        'serviceTestService'                   => 'Gear\Mvc\Service\ServiceTestService',
        'repositoryService'                    => 'Gear\Mvc\Repository\RepositoryService',
        'repositoryTestService'                => 'Gear\Mvc\Repository\RepositoryTestService',
        'RepositoryService\MappingService'     => 'Gear\Mvc\Repository\MappingService',
        'viewService'                          => 'Gear\Service\Mvc\ViewService',
        'ViewService\TableService'             => 'Gear\Service\Mvc\ViewService\TableService',
        'ViewService\FormService'              => 'Gear\Service\Mvc\ViewService\FormService',
        'ViewService\SearchService'            => 'Gear\Service\Mvc\ViewService\SearchService',
        'zendServiceLocatorService'            => 'Gear\Service\Test\ZendServiceLocatorService',
        'Gear\Mvc\Search\SearchService'        => 'Gear\Mvc\Search\SearchService',

    ***REMOVED***
***REMOVED***;