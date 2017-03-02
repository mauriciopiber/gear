<?php
namespace Gear\Database\Phinx;

use Gear\Database\Phinx\PhinxServiceFactory;

trait PhinxServiceTrait
{
    protected $phinxService;

    /**
     * Get Phinx Service
     *
     * @return Gear\Database\Phinx\PhinxService
     */
    public function getPhinxService()
    {
        if (!isset($this->phinxService)) {
            $name = 'Gear\Database\Phinx\PhinxService';
            $this->phinxService = $this->getServiceLocator()->get($name);
        }
        return $this->phinxService;
    }

    /**
     * Set Phinx Service
     *
     * @param PhinxService $phinxService Phinx Service
     *
     * @return \Gear\Database\Phinx\PhinxService
     */
    public function setPhinxService(
        PhinxService $phinxService
    ) {
        $this->phinxService = $phinxService;
        return $this;
    }
}
