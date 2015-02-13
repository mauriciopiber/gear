<?php
namespace Teste\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class EmailEditPage extends LayoutPage
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

    public static function route($param)
    {
        return static::$URL.$param;
    }
}
