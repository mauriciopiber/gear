<?php
namespace TestUntil\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */
class ModuleMainPage
{
    // include url of current page
    public static $URL = 'test-until';

    public static $moduleName = '#moduleName';


    public static function route($param)
    {
        return static::$URL.$param;
    }
}
