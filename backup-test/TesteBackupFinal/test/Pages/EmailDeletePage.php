<?php
namespace Teste\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class EmailDeletePage extends LayoutPage
{
    public static $URL = '/teste/email/excluir';

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
