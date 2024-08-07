<?php
namespace GearTest\MvcTest\FormTest;

use GearTest\SingleDbTableTrait;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;

trait FormDataTrait
{
    use SingleDbTableTrait;
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;

    public function tables()
    {
        return [
            [$this->getSingleColumns(), 'single-db', true, false, false, 'single_db_table', 'factories', null***REMOVED***,
            [$this->getSingleColumns(), 'single-db-namespace', true, false, false, 'single_db_table', 'factories', 'Custom\CustomNamespace'***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db', true, true, true, 'table', 'factories', null***REMOVED***
        ***REMOVED***;
    }
}
