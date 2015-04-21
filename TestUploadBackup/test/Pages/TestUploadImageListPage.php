<?php
namespace TestUpload\Pages;

/**
 * @SuppressWarnings(PHPMD)
 */
class TestUploadImageListPage extends LayoutPage
{
    public static $URL = '/test-upload/test-upload-image/listar';

    public static $title = '#pageTitle';

    public static $filterBtn = '#filterBtn';

    public static $createBtn = '#createBtn';

    public static $filterSearchBtn = '#filterSearchBtn';

    public static $filterClearBtn = '#filterClearBtn';

    public static $filterLikeField = '#likeField';

    public static $paginatorCount = '#paginatorCount';

    public static $paginatorPages = '#paginatorPages';

    public static $paginator = '#paginatorPages > div > ul > li';

    public static $table = '#testUploadImageTable';

    public static $tableHeadRow = '#testUploadImageTable > thead > tr > th';

    public static $tableBodyRow = '#testUploadImageTable > tbody > tr';

    public static $tableBodyRowColumn = '#testUploadImageTable > tbody > tr:nth-child(%d) td';

    public static function getPaginatorByIndex($index)
    {
        return self::$paginator.':nth-child('.$index.')';
    }

    public static function getTableHeadColumnByIndex($index)
    {
        return self::$tableHeadRow.':nth-child('.$index.')';
    }

    public static function getTableBodyRowByIndex($index)
    {
        return self::$tableBodyRow.':nth-child('.$index.')';
    }

    public static function getTableBodyRowColumnByIndex($row, $column)
    {
        return sprintf(self::$tableBodyRowColumn, $row).':nth-child('.$column.')';
    }

    public static function route($param)
    {
        return self::$URL.$param;
    }

    public function getTableItem($item = 1)
    {
        return sprintf(self::$tableBodyItem, $item);
    }

    public function getTableRowColumn($row, $column)
    {
        return sprintf(self::$tableBodyRowColumn, $row, $column);
    }
}
