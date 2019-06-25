<?php
use Gear\Mvc;

return [
    'invokables' => [
        /* config */
        /* config manager */
    ***REMOVED***,
    'factories' => [
        Mvc\Config\ConfigService::class                           => Mvc\Config\ConfigServiceFactory::class,
        Mvc\Entity\EntityService::class                           => Mvc\Entity\EntityServiceFactory::class,
        Mvc\LanguageService::class                                => Mvc\LanguageServiceFactory::class,
        Mvc\Factory\FactoryService::class                         => Mvc\Factory\FactoryServiceFactory::class,
        Mvc\Factory\FactoryTestService::class                     => Mvc\Factory\FactoryTestServiceFactory::class,

    ***REMOVED***,

***REMOVED***;
