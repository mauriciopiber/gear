<?php
namespace Teste\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class EmailCreatePage
{
    public static $URL = '/teste/email/criar';

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
