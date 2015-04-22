<?php
namespace Column\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */
class ForeignKeysDeletePage extends LayoutPage
{
    public static $URL = '/column/foreign-keys/excluir';

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
