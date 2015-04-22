<?php
namespace Column\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class ForeignKeysEditPage extends LayoutPage
{
    public static $URL = '/column/foreign-keys/editar';

    public static $title = '#pageTitle';

    public static $idForeignKeys = '#idForeignKeys';

    public static $name = '#name';

    public static $submit = 'input[name=submit***REMOVED***';

    public static $back = '.reset';

    public static function route($param)
    {
        return static::$URL.$param;
    }
}
