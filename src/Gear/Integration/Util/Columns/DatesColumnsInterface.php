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
interface DatesColumnsInterface
{
    // TIME
    const DEFAULT_TIME           = 'column_time';

    //DATETIME
    const DEFAULT_DATETIME      = 'column_datetime';
    const DEFAULT_DATETIME_PTBR = self::DEFAULT_DATETIME.'_ptbr';

     // DATE
    const DEFAULT_DATE          = 'column_date';
    const DEFAULT_DATE_PTBR     = self::DEFAULT_DATE.'_ptbr';

    const COLUMNS = [
        self::DEFAULT_TIME          => ['type' => 'time'***REMOVED***,
        self::DEFAULT_DATETIME      => ['type' => 'datetime'***REMOVED***,
        self::DEFAULT_DATETIME_PTBR => ['type' => 'datetime', 'speciality' => 'datetime-pt-br'***REMOVED***,
        self::DEFAULT_DATE          => ['type' => 'date'***REMOVED***,
        self::DEFAULT_DATE_PTBR     => ['type' => 'date', 'speciality' => 'date-pt-br'***REMOVED***
    ***REMOVED***;
}
