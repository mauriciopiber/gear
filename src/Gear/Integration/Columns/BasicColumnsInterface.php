<?php
namespace Gear\Integration\Columns;

use Gear\Integration\Columns\DatesColumnsInterface;
use Gear\Integration\Columns\NumericColumnsInterface;
use Gear\Integration\Columns\TextColumnsInterface;
use Gear\Integration\Columns\VarcharColumnsInterface;

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
        DatesColumnsInterface::default_time        => ['type' => 'time'***REMOVED***,
        DatesColumnsInterface::default_datetime    => ['type' => 'datetime'***REMOVED***,
        DatesColumnsInterface::default_date        => ['type' => 'date'***REMOVED***,
        VarcharColumnsInterface::default_varchar   => ['type' => 'string'***REMOVED***,
        TextColumnsInterface::default_text        => ['type' => 'text'***REMOVED***,
        NumericColumnsInterface::default_decimal  => ['type' => 'decimal'***REMOVED***,
        NumericColumnsInterface::default_boolean  => ['type' => 'boolean'***REMOVED***,
        NumericColumnsInterface::default_int      => ['type' => 'integer'***REMOVED***,
    ***REMOVED***;
}
