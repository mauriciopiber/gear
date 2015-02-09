<?php
namespace Teste\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class EmailListPage
{
    public static $URL = '/teste/email/listar';

    public static $title = '#pageTitle';

    public static $breadscrumbList = 'ul.breadcrumb li';

    public static $breadscrumbModule = 'ul.breadcrumb li:first-child';

    public static $breadscrumbController = 'ul.breadcrumb li:first-child + li';

    public static $breadscrumbAction = 'ul.breadcrumb li:first-child + li + li';

    public static $filterBtn = '#filterBtn';

    public static $createBtn = '#createBtn';

    public static $filterSearchBtn = '#filterSearchBtn';

    public static $filterClearBtn = '#filterClearBtn';

    public static $filterLikeField = '#likeField';

    public static $paginatorCount = '#paginatorCount';

    public static $paginatorPages = '#paginatorPages';

    public static $paginatorList = '#paginatorPages > div > ul > li';

    public static $paginatorOne   = '#paginatorPages > div > ul > li:first-child';
    public static $paginatorTwo   = '#paginatorPages > div > ul > li:first-child + li';
    public static $paginatorThree = '#paginatorPages > div > ul > li:first-child + li + li';
    public static $paginatorFour  = '#paginatorPages > div > ul > li:first-child + li + li + li';
    public static $paginatorFive  = '#paginatorPages > div > ul > li:first-child + li + li + li + li';

    public static $table = '#emailTable';

    public static $tableHead = '#emailTable > thead > tr > th';

    public static $tableHeadActions = '#emailTable > thead > tr > th:last-child';

    public static $tableBodyRows = '#emailTable > tbody > tr';

    public static $tableBodyItem = '#emailTable > tbody > tr:nth-child(%d)';

    public static $tableBodyRowColumn = '#emailTable > tbody > tr:nth-child(%d) td:nth-child(%d)';


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
