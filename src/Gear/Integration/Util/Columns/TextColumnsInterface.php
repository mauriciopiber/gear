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
interface TextColumnsInterface
{
    const default_text = 'clm_txt';
    const default_text_html = self::default_text.'_htm';

    const COLUMNS = [
        self::default_text      => ['type' => 'text'***REMOVED***,
        self::default_text_html => ['type' => 'text', 'speciality' => 'html'***REMOVED***,

    ***REMOVED***;
}
