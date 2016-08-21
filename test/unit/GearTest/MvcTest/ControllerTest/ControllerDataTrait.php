<?php
namespace GearTest\MvcTest\ControllerTest;

use GearTest\SingleDbTableTrait;
use GearTest\AllColumnsDbTableTrait;
use GearTest\LongNameTableTrait;

trait ControllerDataTrait
{
    use LongNameTableTrait;
    use SingleDbTableTrait;
    use AllColumnsDbTableTrait;

    public function tables()
    {
        return [
            [$this->getAllPossibleColumns(), 'all-columns-db', true, true, true, 'table', 'invokables', null***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-factory', true, true, true, 'table', 'factories', null***REMOVED***,
            [$this->getSingleColumns(), 'single-db', true, false, false, 'single_db_table', 'invokables', null***REMOVED***,
            [$this->getSingleColumns(), 'single-db-namespace', true, false, false, 'single_db_table', 'invokables', 'Custom\CustomNamespace'***REMOVED***,
            [$this->getSingleColumns(), 'single-db-factory', true, false, false, 'single_db_table', 'factories', null***REMOVED***,
            [$this->getSingleColumns(), 'single-db-factory-namespace', true, false, false, 'single_db_table', 'factories', 'Custom\CustomNamespace'***REMOVED***,
            [$this->getLongNameTableColumns(), 'long-name-table', true, true, true, 'my_very_long_table_name_example', 'factories', 'Custom\CustomNamespace'***REMOVED***
            //[$this->getAllPossibleColumnsNotNull(), 'all-columsn-db-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), 'all-columsn-db-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), 'all-columsn-db-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }
}
