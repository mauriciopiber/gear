<?php
namespace Gear\Integration\Util\ResolveNames;

use Gear\Integration\Util\ResolveNames\ResolveNamesFactory;

trait ResolveNamesTrait
{
    protected $resolveNames;

    /**
     * Get Resolve Names
     *
     * @return Gear\Integration\Util\ResolveNames\ResolveNames
     */
    public function getResolveNames()
    {
        return $this->resolveNames;
    }

    /**
     * Set Resolve Names
     *
     * @param ResolveNames $resolveNames Resolve Names
     *
     * @return \Gear\Integration\Util\ResolveNames\ResolveNames
     */
    public function setResolveNames(
        ResolveNames $resolveNames
    ) {
        $this->resolveNames = $resolveNames;
        return $this;
    }
}
