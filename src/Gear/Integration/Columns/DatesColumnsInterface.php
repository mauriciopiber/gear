<?php
namespace Gear\Integration\Columns;

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
    const default_time           = 'clm_tme';

    //DATETIME
    const default_datetime      = 'clm_dtt';
    const default_datetime_ptbr = self::default_datetime.'_pt';

     // DATE
    const default_date          = 'clm_dte';
    const default_date_ptbr     = self::default_date.'_pt';

    const COLUMNS = [
        self::default_time              => ['type' => 'time'***REMOVED***,
        self::default_datetime          => ['type' => 'datetime'***REMOVED***,
        self::default_datetime_ptbr     => ['type' => 'datetime', 'speciality' => 'datetime-pt-br'***REMOVED***,
        self::default_date              => ['type' => 'date'***REMOVED***,
        self::default_date_ptbr         => ['type' => 'date', 'speciality' => 'date-pt-br'***REMOVED***
    ***REMOVED***;
}
