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
        /*
         * $columns, //colunas do ColumnService
         * $template, //template pra resolver o teste
         * $nullable, //se é nullable.
         * $hasColumnImage, //se tem coluna de imagem
         * $hasTableImage, //se tem tabela de imagem
         * $tableName, //nome da tabela
         * $service, //qual service é utilizado
         * $namespace, //namespace
         * $userType //usuario
         */
        return [
            [$this->getUploadImageColumns('my_table_columns'), 'upload-image-columns', false, true, false, 'my_table_column', 'factories', 'MyTableColumn', 'all'***REMOVED***,
            [$this->getSingleColumns('my-table-table'), 'upload-image-table', false, false, true, 'my_table_table', 'factories', 'MyTableTable', 'all'***REMOVED***,
            [$this->getUploadImageColumns('my-table-all'), 'upload-image-all', false, true, true, 'my_table_all', 'factories', 'MyTableAll', 'all'***REMOVED***,
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
        ***REMOVED***;
    }
}
