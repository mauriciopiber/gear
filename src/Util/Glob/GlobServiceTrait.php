<?php
namespace Gear\Util\Glob;

use Gear\Util\Glob\GlobService;

trait GlobServiceTrait
{
    protected $globService;

    /**
     * Get Glob Service
     *
     * @return Gear\Util\Glob\GlobService
     */
    public function getGlobService()
    {
        if (!isset($this->globService)) {
            $name = 'Gear\Util\Glob\GlobService';
            $this->globService = $this->getServiceLocator()->get($name);
        }
        return $this->globService;
    }

    /**
     * Set Glob Service
     *
     * @param GlobService $globService Glob Service
     *
     * @return \Gear\Util\Glob\GlobService
     */
    public function setGlobService(
        GlobService $globService
    ) {
        $this->globService = $globService;
        return $this;
    }
}