<?php
namespace Gear\Integration\Util\Columns;

/**
 * PHP Version 5
 *
 * @category Interface
 * @package Gear/Integration/Columns
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
interface NumericColumnsInterface
{

    // DECIMAL
    const DEFAULT_DECIMAL = 'column_decimal';

    const DEFAULT_DECIMAL_MONEY_PTBR = self::DEFAULT_DECIMAL.'_money';

    // BOOLEAN
    const DEFAULT_BOOLEAN = 'column_boolean';
    const DEFAULT_BOOLEAN_CHECKBOX = self::DEFAULT_BOOLEAN.'_checkbox';


    // INT
    const DEFAULT_INT = 'column_int';
    const DEFAULT_INT_CHECKBOX = self::DEFAULT_INT.'_checkbox';
    const DEFAULT_ID_INT_FOREIGN_KEY = 'id_'.self::DEFAULT_INT.'_foreign';


    const COLUMNS = [
        self::DEFAULT_DECIMAL             => ['type' => 'decimal'***REMOVED***,
        self::DEFAULT_DECIMAL_MONEY_PTBR  => ['type' => 'decimal', 'speciality' => 'money-pt-br'***REMOVED***,
        self::DEFAULT_BOOLEAN             => ['type' => 'boolean'***REMOVED***,
        self::DEFAULT_BOOLEAN_CHECKBOX    => ['type' => 'boolean', 'speciality' => 'checkbox', 'unique' => false***REMOVED***,
        self::DEFAULT_INT                 => ['type' => 'integer'***REMOVED***,
        self::DEFAULT_INT_CHECKBOX        => ['type' => 'integer', 'speciality' => 'checkbox', 'unique' => false***REMOVED***,
        self::DEFAULT_ID_INT_FOREIGN_KEY  => ['type' => 'integer', 'properties' => ['foreignKey'***REMOVED***, 'unique' => false***REMOVED***,
    ***REMOVED***;
}
