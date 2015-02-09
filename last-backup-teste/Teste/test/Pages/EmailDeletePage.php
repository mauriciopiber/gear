<?php
namespace Teste\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class EmailDeletePage
{
    public static $URL = '/teste/email/excluir';

    public static function route($param)
    {
        return static::$URL.$param;
    }
}
