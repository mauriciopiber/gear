<?php
return array_merge_recursive(
    [
        'abstract_factories' =>
        [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Gear\Mvc\Config\AbstractConfigManagerFactory',
            'Gear\Edge\AbstractEdgeFactory',
            'Gear\Mvc\AbstractMvcFactory',
            'Gear\Mvc\AbstractMvcTestFactory'
         ***REMOVED***,
        'factories' => [
            'Zend\Db\Adapter\Adapter'          => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Gear\Module'                      => 'Gear\Module\ModuleServiceFactory',
            'Gear\Module\ModuleService'        => 'Gear\Module\ModuleServiceFactory',
            'Gear\Module\ConstructStatusObject' => 'Gear\Module\ConstructStatusObjectFactory',
            \Gear\Creator\FileCreator\FileCreator::class => \Gear\Creator\FileCreator\FileCreatorFactory::class,
            'Gear\Table\Metadata'              => 'Gear\Table\Metadata\MetadataFactory',
            'Gear\Table\Table'                 => 'Gear\Table\TableService\TableFactory',
            'Gear\Creator\Template\TemplateService'  => 'Gear\Creator\Template\TemplateServiceFactory',
            'Gear\Code\Code'                => 'Gear\Code\CodeFactory',
            'Gear\Code\CodeTest'            => 'Gear\Code\CodeTestFactory',
        ***REMOVED***,
        'shared' => [
            'Gear\Module\ConstructStatusObject' => false,
    	    \Gear\Creator\FileCreator\FileCreator::class => false,
            'Gear\Autoload\Namespaces' => false,
        ***REMOVED***,
    ***REMOVED***,
    require __DIR__.'/servicemanager/mvc.php',
    require __DIR__.'/servicemanager/constructor.php',
    require __DIR__.'/servicemanager/module.php',
    require __DIR__.'/servicemanager.config.php'
);
