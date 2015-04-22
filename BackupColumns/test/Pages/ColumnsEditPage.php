<?php
namespace Column\Pages;

/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

class ColumnsEditPage extends LayoutPage
{
    public static $URL = '/column/columns/editar';

    public static $title = '#pageTitle';

    public static $idColumns = '#idColumns';

    public static $columnDate = '#columnDate';

    public static $columnDatetime = '#columnDatetime';

    public static $columnTime = '#columnTime';

    public static $columnInt = '#columnInt';

    public static $columnTinyint = '#columnTinyint';

    public static $columnDecimal = '#columnDecimal';

    public static $columnVarchar = '#columnVarchar';

    public static $columnLongtext = '#columnLongtext';

    public static $columnText = '#columnText';

    public static $columnDatetimePtBr = '#columnDatetimePtBr';

    public static $columnDatePtBr = '#columnDatePtBr';

    public static $columnDecimalPtBr = '#columnDecimalPtBr';

    public static $columnIntCheckbox = '#columnIntCheckbox';

    public static $columnTinyintCheckbox = '#columnTinyintCheckbox';

    public static $columnVarcharEmail = '#columnVarcharEmail';

    public static $columnVarcharPasswordVerify = '#columnVarcharPasswordVerify';

    public static $columnVarcharUniqueId = '#columnVarcharUniqueId';

    public static $columnVarcharUploadImage = '#columnVarcharUploadImage';

    public static $columnForeignKey = '#columnForeignKey';

    public static $submit = 'input[name=submit***REMOVED***';

    public static $back = '.reset';

    public static function route($param)
    {
        return static::$URL.$param;
    }
}
