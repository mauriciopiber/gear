<?php
namespace Gear\Integration\Util\Persist;

use Gear\Integration\Util\Location\LocationTrait;
use Gear\Integration\Util\Location\Location;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Util/Persist
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class Persist
{
    use LocationTrait;

    /**
     * Constructor
     *
     * @param Location $location Location
     *
     * @return \Gear\Integration\Util\Persist\Persist
     */
    public function __construct(Location $location)
    {
        $this->location = $location;

        return $this;
    }
}
