<?php
namespace TestUpload\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class TestUploadImageEditPage extends LayoutPage
{
    public static $URL = '/test-upload/test-upload-image/editar';

    public static $title = '#pageTitle';

    public static $idTestUploadImage = '#idTestUploadImage';

    public static $image = '#image';

    public static $submit = 'input[name=submit***REMOVED***';

    public static $back = '.reset';

    public static function route($param)
    {
        return static::$URL.$param;
    }
}
