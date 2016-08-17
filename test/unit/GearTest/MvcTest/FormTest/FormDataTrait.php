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
            [$this->getSingleColumns(), 'single-db', true, false, false, 'single_db_table'***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db', true, true, true, 'table'***REMOVED***
        ***REMOVED***;
    }
}
