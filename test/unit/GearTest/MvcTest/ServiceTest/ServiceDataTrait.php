<?php
namespace GearTest\MvcTest\ServiceTest;

use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use GearTest\SingleDbTableTrait;

trait ServiceDataTrait
{
    use SingleDbTableTrait;
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;

    public function tables()
    {
        return [
            // [$this->getAllPossibleColumns(), 'all-columns-db', true, true, true, 'table', 'invokables', null***REMOVED***,
            [
                $this->getAllPossibleColumns(),
                'all-columns-db-factory',
                true,
                true,
                true,
                'AllColumnsDb',
                'factories',
                'Custom\CustomNamespace'
            ***REMOVED***,
            [
                $this->getSingleColumns(),
                'all-columns-db-upload-image',
                false,
                false,
                true,
                'DbUploadImage',
                'factories',
                'Custom\CustomNamespace'
            ***REMOVED***,

            // [$this->getSingleColumns(), 'single-db', true, false, false, 'single_db_table', 'invokables', null***REMOVED***,
            [
                $this->getSingleColumns(),
                'single-db-factory',
                true,
                false,
                false,
                'single_db_table',
                'factories',
                null
            ***REMOVED***,
            // [$this->getSingleColumns(), 'single-db-namespace', true, false, false, 'single_db_table', 'invokables', 'Custom\CustomNamespace'***REMOVED***,
            [
                $this->getSingleColumns(),
                'single-db-factory-namespace',
                true,
                false,
                false,
                'single_db_table',
                'factories',
                'Custom\CustomNamespace'
            ***REMOVED***,
            [
                $this->getSingleColumns(),
                'single-db-user-strict',
                true,
                false,
                false,
                'single_db_table',
                'factories',
                'Custom\CustomNamespace',
                'strict'
            ***REMOVED***,
            [
                $this->getSingleColumns(),
                'single-db-user-low-strict',
                true,
                false,
                false,
                'single_db_table',
                'factories',
                'Custom\CustomNamespace',
                'low-strict'
            ***REMOVED***
        ***REMOVED***;
    }
}
