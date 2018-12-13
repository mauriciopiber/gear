<?php
namespace Gear\Diagnostic\Npm;

use Gear\Diagnostic\NpmServiceFactory;

trait NpmServiceTrait
{
    protected $npmService;

    public function getNpmService()
    {
        if (!isset($this->npmService)) {
            $name = 'Gear\Diagnostic\Npm\NpmService';
            $this->npmService = $this->getServiceLocator()->get($name);
        }
        return $this->npmService;
    }

    public function setNpmService(
        NpmService $npmService
    ) {
        $this->npmService = $npmService;
        return $this;
    }
}
