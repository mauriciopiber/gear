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
            [$this->getAllPossibleColumns(), 'all-columns-db-factory', false, false, true, false, 'table', 'factories', null***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-factory-namespace', false, false, true, false, 'table', 'factories', 'Custom\CustomNamespace'***REMOVED***,
        ***REMOVED***;
    }
}
