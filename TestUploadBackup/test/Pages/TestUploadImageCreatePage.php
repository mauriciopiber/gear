<?php
namespace TestUpload\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */
class TestUploadImageCreatePage extends LayoutPage
{
    public static $URL = '/test-upload/test-upload-image/criar';

    public static $title = '#pageTitle';

    public static $image = '#image';

    public static $submit = 'input[name=submit***REMOVED***';

    public static $back = '.reset';

    public static function route($param)
    {
        return static::$URL.$param;
    }
}
