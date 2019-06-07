<?php
namespace Gear\Integration\Util\Persist;

use Gear\Integration\Util\Persist\PersistFactory;

trait PersistTrait
{
    protected $persist;

    /**
     * Get Persist
     *
     * @return Gear\Integration\Util\Persist\Persist
     */
    public function getPersist()
    {
        return $this->persist;
    }

    /**
     * Set Persist
     *
     * @param Persist $persist Persist
     *
     * @return \Gear\Integration\Util\Persist\Persist
     */
    public function setPersist(
        Persist $persist
    ) {
        $this->persist = $persist;
        return $this;
    }
}
