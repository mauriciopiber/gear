<?php
namespace TestUpload\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */
class TestUploadImageDeletePage extends LayoutPage
{
    public static $URL = '/test-upload/test-upload-image/excluir';

    public static $title = '#pageTitle';

    public static $modalTitle = '.modal-title';

    public static $modalText = '.modal-body p';

    public static $btnConfirm = '#confirm';

    public static $btnCancel = '#cancelDelete';

    public static function route($param)
    {
        return static::$URL.$param;
    }
}
