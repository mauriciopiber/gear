<?php
namespace Gear\Integration\Util\Columns;

use Gear\Integration\Util\Columns\DatesColumnsInterface;
use Gear\Integration\Util\Columns\NumericColumnsInterface;
use Gear\Integration\Util\Columns\TextColumnsInterface;
use Gear\Integration\Util\Columns\VarcharColumnsInterface;

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
        DatesColumnsInterface::DEFAULT_TIME      => ['type' => 'time'***REMOVED***,
        DatesColumnsInterface::DEFAULT_DATETIME  => ['type' => 'datetime'***REMOVED***,
        DatesColumnsInterface::DEFAULT_DATE      => ['type' => 'date'***REMOVED***,
        VarcharColumnsInterface::DEFAULT_VARCHAR => ['type' => 'string'***REMOVED***,
        TextColumnsInterface::DEFAULT_TEXT       => ['type' => 'text'***REMOVED***,
        NumericColumnsInterface::DEFAULT_DECIMAL => ['type' => 'decimal'***REMOVED***,
        NumericColumnsInterface::DEFAULT_BOOLEAN => ['type' => 'boolean'***REMOVED***,
        NumericColumnsInterface::DEFAULT_INT     => ['type' => 'integer'***REMOVED***,
    ***REMOVED***;
}
