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
    const DEFAULT_TEXT      = 'column_text';

    const DEFAULT_TEXT_HTML = self::DEFAULT_TEXT.'_html';

    const COLUMNS = [
        self::DEFAULT_TEXT      => ['type' => 'text'***REMOVED***,
        self::DEFAULT_TEXT_HTML => ['type' => 'text', 'speciality' => 'html'***REMOVED***,

    ***REMOVED***;
}
