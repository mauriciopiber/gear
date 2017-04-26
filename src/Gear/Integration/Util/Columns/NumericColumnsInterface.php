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
    const default_decimal = 'clm_dcm';
    const default_decimal_money_ptbr = self::default_decimal.'_mny';

    // BOOLEAN
    const default_boolean = 'clm_boo';
    const default_boolean_checkbox = self::default_boolean.'_chc';


    // INT
    const default_int = 'clm_int';
    const default_int_checkbox = self::default_int.'_chc';
    const default_id_int_foreign_key = 'id_'.self::default_int.'_frk';


    const COLUMNS = [
        self::default_decimal             => ['type' => 'decimal'***REMOVED***,
        self::default_decimal_money_ptbr => ['type' => 'decimal', 'speciality' => 'money-pt-br'***REMOVED***,
        self::default_boolean             => ['type' => 'boolean'***REMOVED***,
        self::default_boolean_checkbox    => ['type' => 'boolean', 'speciality' => 'checkbox', 'unique' => false***REMOVED***,
        self::default_int                 => ['type' => 'integer'***REMOVED***,
        self::default_int_checkbox        => ['type' => 'integer', 'speciality' => 'checkbox', 'unique' => false***REMOVED***,
        self::default_id_int_foreign_key  => ['type' => 'integer', 'properties' => ['foreignKey'***REMOVED***, 'unique' => false***REMOVED***,
    ***REMOVED***;
}
