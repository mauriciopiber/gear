<?php
namespace Gear\Integration\Columns;

use DatesColumnInterface;
use NumericColumnInterface;
use TextColumnInterface;
use VarcharColumnInterface;

/**
 * PHP Version 5
 *
 * @category Interface
 * @package Gear/Integration/Columns
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
interface BasicColumnsInterface
{
    const COLUMNS = [
        DatesColumnInterface::default_time        => ['type' => 'time'***REMOVED***,
        DatesColumnInterface::default_datetime    => ['type' => 'datetime'***REMOVED***,
        DatesColumnInterface::default_date        => ['type' => 'date'***REMOVED***,
        VarcharColumnsInterface:default_varchar   => ['type' => 'string'***REMOVED***,
        TextColumnsInterface::default_text        => ['type' => 'text'***REMOVED***,
        NumericColumnsInterface::default_decimal  => ['type' => 'decimal'***REMOVED***,
        NumericColumnsInterface::default_boolean  => ['type' => 'boolean'***REMOVED***,
        NumericColumnsInterface::default_int      => ['type' => 'integer'***REMOVED***,
    ***REMOVED***;
}
