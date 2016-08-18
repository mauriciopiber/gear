<?php
namespace GearTest\MvcTest\FilterTest;

use GearTest\SingleDbTableTrait;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;

trait FilterDataTrait
{
    use SingleDbTableTrait;
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;


    /**
     * $columns, $expect, $nullable, $unique, $tableName, $service, $namespace)
     */

    /**
        $columns,
        $template,
        $unique
        $nullable,
        $hasColumnImage,
        $hasTableImage,
        $tableName,
        $service,
        $namespace
     */
    public function tables()
    {
        return [
            [$this->getAllPossibleColumns(), 'all-columns-db', false, false, true, false, 'table', 'invokables', null***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-factory', false, false, true, false, 'table', 'factories', null***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-namespace', false, false, true, false, 'table', 'invokables', 'Custom\CustomNamespace'***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-factory-namespace', false, false, true, false, 'table', 'factories', 'Custom\CustomNamespace'***REMOVED***,
            [$this->getAllPossibleColumnsNotNull(), 'all-columns-db-not-null', false, false, false, false, 'table_not_null', 'invokables', null***REMOVED***,
            [$this->getAllPossibleColumnsUniqueNotNull(), 'all-columns-db-unique-not-null', false, false, false, true, 'table_unique_not_null', 'invokables', null***REMOVED***,
        ***REMOVED***;
    }
}
