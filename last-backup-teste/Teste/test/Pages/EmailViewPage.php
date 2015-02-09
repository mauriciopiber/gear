<?php
namespace Teste\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class EmailViewPage
{
    public static $URL = '/teste/email/visualizar';

    public static function route($param)
    {
        return static::$URL.$param;
    }
}
