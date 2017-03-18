<?php
return [
    'invokables' => [
        'Gear\Database\SchemaTool' => 'Gear\Database\SchemaToolService',
        'Gear\Database\Table'      => 'Gear\Database\Table\TableService',
        'autoincrementService'     => 'Gear\Database\AutoincrementService',
        'Gear\Database\Fixture'    => 'Gear\Database\FixtureService',
    ***REMOVED***,
    'factories' => [
        'backupService'            => 'Gear\Database\BackupServiceFactory',
        'Gear\Database\DbConnector' => 'Gear\Database\Connector\DbConnector\DbConnectorFactory',
        'Gear\Database\PhinxConnector' => 'Gear\Database\Connector\PhinxConnector\PhinxConnectorFactory'
    ***REMOVED***


***REMOVED***;