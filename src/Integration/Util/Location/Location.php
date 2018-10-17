<?php
namespace Gear\Integration\Util\Location;

use Gear\Module;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Util/Location
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class Location
{
    public function getLocation()
    {
        return realpath((new Module())->getLocation().'/../test/integration/main/constructors');
    }
}
