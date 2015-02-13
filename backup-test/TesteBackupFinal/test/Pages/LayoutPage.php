<?php
namespace Teste\Pages;

/**
 * @author Maurício Piber Fão
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
