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

    public function tables()
    {
        return [
            [$this->getAllPossibleColumns(), 'all-columns-db', true, false, 'table', 'invokables', null***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-factory', true, false, 'table', 'factories', null***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-namespace', true, false, 'table', 'invokables', 'Custom\CustomNamespace'***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-factory-namespace', true, false, 'table', 'factories', 'Custom\CustomNamespace'***REMOVED***,
            [$this->getAllPossibleColumnsNotNull(), 'all-columns-db-not-null', false, false, 'table_not_null', 'invokables', null***REMOVED***,
            [$this->getAllPossibleColumnsUniqueNotNull(), 'all-columns-db-unique-not-null', false, true, 'table_unique_not_null', 'invokables', null***REMOVED***,
        ***REMOVED***;
    }
}
