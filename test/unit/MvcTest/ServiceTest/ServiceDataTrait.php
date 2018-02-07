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
        /*
         * $template,
         * $nullable,
         * $hasColumnImage,
         * $hasTableImage,
         * $tableName,
         * $service,
         * $namespace,
         * $user = 'all'
         */
        return [
            [$this->getUploadImageColumns('my_table_columns'), 'upload-image-columns', false, true, false, 'my_table_column', 'factories', 'MyTableColumn', 'all'***REMOVED***,
            [$this->getSingleColumns('my_table_table'), 'upload-image-table', false, false, true, 'my_table_table', 'factories', 'MyTableTable', 'all'***REMOVED***,
            [$this->getUploadImageColumns('my_table_all'), 'upload-image-all', false, true, true, 'my_table_all', 'factories', 'MyTableAll', 'all'***REMOVED***,
            // [$this->getAllPossibleColumns(), 'all-columns-db', true, true, true, 'table', 'invokables', null***REMOVED***,
            [
                $this->getAllPossibleColumns('all_columns_db'),
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
