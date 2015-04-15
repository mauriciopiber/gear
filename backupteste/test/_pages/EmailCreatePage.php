<?php
namespace Teste\Pages;

class EmailCreatePage
{
    public static $URL = '/teste/email/criar';

    public static $title = '#pageTitle';

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
    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit***REMOVED***";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: EditPage::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }


}