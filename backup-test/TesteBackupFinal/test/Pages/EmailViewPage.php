<?php
namespace Teste\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class EmailViewPage extends LayoutPage
{
    public static $URL = '/teste/email/visualizar';

    public static $title = '#pageTitle';

    public static $btnBack = '#btnBack';

    public static $btnPrev = '#btnPrev';

    public static $btnNext = '#btnNext';

    public static $btnEdit = '#btnExit';

    public static $btnDelete = '#btnDelete';

    public static $btnCreate = '#btnCreate';

    public static $labels = '#viewData tbody tr:nth-child(%d) td:nth-child(1)';

    public static $values = '#viewData tbody tr:nth-child(%d) td:nth-child(2)';

    public static function route($param)
    {
        return static::$URL.$param;
    }

    public static function getLabelByIndex($index)
    {
        return sprintf(self::$labels, $index);
    }

    public static function getValueByIndex($index)
    {
        return sprintf(self::$values, $index);
    }
}
