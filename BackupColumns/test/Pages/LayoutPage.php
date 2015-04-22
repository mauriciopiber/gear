<?php
namespace Column\Pages;

/**
 * @SuppressWarnings(PHPMD)
 */
class LayoutPage
{
    public static $breadscrumb = 'ul.breadcrumb li';

    public static function getBreadcrumbByIndex($index)
    {
        return self::$breadscrumb.':nth-child('.$index.')';
    }
}
