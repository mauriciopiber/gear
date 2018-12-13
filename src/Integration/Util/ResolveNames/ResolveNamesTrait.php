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
        if (!isset($this->resolveNames)) {
            $name = 'Gear\Integration\Util\ResolveNames\ResolveNames';
            $this->resolveNames = $this->getServiceLocator()->get($name);
        }
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
