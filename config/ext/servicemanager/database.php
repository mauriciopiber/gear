<?php
return [
    'invokables' => [
        'Gear\Database\SchemaTool' => 'Gear\Database\SchemaToolService',
        'Gear\Database\Table'      => 'Gear\Database\TableService',
        'autoincrementService'     => 'Gear\Database\AutoincrementService',
        'Gear\Database\Fixture'    => 'Gear\Database\FixtureService',
    ***REMOVED***,
    'factories' => [
        'backupService'            => 'Gear\Database\BackupServiceFactory'
    ***REMOVED***


***REMOVED***;