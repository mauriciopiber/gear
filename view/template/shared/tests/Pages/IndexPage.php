<?php
namespace Security\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */
class IndexPage
{
    // include url of current page
    public static $URL = 'security';

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
