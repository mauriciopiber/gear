<?php
namespace Gear\Integration\Util\Location;

use Gear\Integration\Util\Location\Location;

trait LocationTrait
{
    protected $location;

    /**
     * Get Location
     *
     * @return Gear\Integration\Util\Location\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set Location
     *
     * @param Location $location Location
     *
     * @return \Gear\Integration\Util\Location\Location
     */
    public function setLocation(
        Location $location
    ) {
        $this->location = $location;
        return $this;
    }
}
