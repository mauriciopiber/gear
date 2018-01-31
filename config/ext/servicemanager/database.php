<?php
return [
    'invokables' => [
        'Gear\Database\SchemaTool'                 => 'Gear\Database\SchemaToolService',
        'Gear\Database\Table'                      => 'Gear\Database\Table\TableService',
        \Gear\Database\AutoincrementService::class => \Gear\Database\AutoincrementService::class,
        'Gear\Database\Fixture'                    => 'Gear\Database\FixtureService',
    ***REMOVED***,
    'factories' => [
        'backupService'                => 'Gear\Database\BackupServiceFactory',
        'Gear\Database\DbConnector'    => 'Gear\Database\Connector\DbConnector\DbConnectorFactory',
        'Gear\Database\PhinxConnector' => 'Gear\Database\Connector\PhinxConnector\PhinxConnectorFactory'
    ***REMOVED***,
    'aliases' => [
        'autoincrementService' => \Gear\Database\AutoincrementService::class
    ***REMOVED***


***REMOVED***;