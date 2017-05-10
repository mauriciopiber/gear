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
            //[$this->getAllPossibleColumns(), 'all-columns-db', true, true, true, 'table', 'invokables', null, 'all'***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-factory', true, true, true, 'table', 'factories', null, 'all'***REMOVED***,
            [$this->getSingleColumns(), 'single-db-factory', true, false, false, 'single_db_table', 'factories', null, 'all'***REMOVED***,
            [
                $this->getSingleColumns(),
                'single-db-usertype-low-strict',
                true,
                false,
                false,
                'single_db_table',
                'factories',
                'Custom\CustomNamespace',
                'low-strict'
            ***REMOVED***,
            [
                $this->getSingleColumns(),
                'single-db-usertype-strict',
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
                'single-db-factory-namespace',
                true,
                false,
                false,
                'single_db_table',
                'factories',
                'Custom\CustomNamespace',
                'all'
            ***REMOVED***,
            [
                $this->getLongNameTableColumns(),
                'long-name-table',
                true,
                true,
                true,
                'my_very_long_table_name_example',
                'factories',
                'Custom\CustomNamespace',
                'all'
            ***REMOVED***,
            [
                $this->getSingleColumns(),
                'single-db-upload-image-table',
                true,
                false,
                true,
                'upload_image_table',
                'factories',
                'Custom\CustomNamespace',
                'all'
            ***REMOVED***,
            [
                $this->getAllPossibleColumns(),
                'single-db-upload-image-column',
                true,
                true,
                false,
                'upload_image_column',
                'factories',
                'Custom\CustomNamespace',
                'all'
            ***REMOVED***
            //[$this->getAllPossibleColumnsNotNull(), 'all-columsn-db-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), 'all-columsn-db-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), 'all-columsn-db-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }
}
