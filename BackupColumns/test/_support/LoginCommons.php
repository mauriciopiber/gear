<?php
namespace Column;

/**
 * @SuppressWarnings(PHPMD)
 * @author piber
 */
class LoginCommons
{
    public static $identity = 'usuariogear1@gmail.com';
    public static $credential = 'usuariogear1';

    public static function logMeIn($I)
    {
        self::logMeOut($I);
        $I->amOnPage('/admin');
        $I->fillField('#identity', self::$identity);
        $I->fillField('#credential', self::$credential);
        $I->click('Login');
    }

    public static function logMeOut($I)
    {
        $I->amOnPage('/admin/logout');
    }
}
