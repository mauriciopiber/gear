<?php
namespace Teste\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class EmailEditPage
{
    public static $URL = '/teste/email/editar';

    public static $title = '#pageTitle';

    public static $idEmail = '#idEmail';

    public static $remetente = '#remetente';

    public static $destino = '#destino';

    public static $assunto = '#assunto';

    public static $mensagem = '#mensagem';

    public static $submit = 'input[name=submit***REMOVED***';

    public static $back = '.reset';

    public static $breadscrumb = 'ul.breadcrumb li';

    public static function getBreadcrumbByIndex($index)
    {
        return self::$breadscrumb.':nth-child('.$index.')';
    }

    public static function route($param)
    {
        return static::$URL.$param;
    }
}
