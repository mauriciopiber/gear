<?php
namespace GearTest\MvcTest\SearchTest;

use GearTest\SingleDbTableTrait;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;

trait SearchDataTrait
{
    use SingleDbTableTrait;
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;

    public function tables()
    {
        return [
            [$this->getSingleColumns(), 'single-db-factory', true, false, false, 'single_db_table', 'factories', null***REMOVED***,
            //
            [$this->getSingleColumns(), 'single-db-factory-namespace', true, false, false, 'single_db_table', 'factories', 'Custom\CustomNamespace'***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db', true, true, true, 'table', 'invokables', null***REMOVED***
        ***REMOVED***;
    }
}
