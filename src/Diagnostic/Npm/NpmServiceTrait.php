<?php
namespace Gear\Diagnostic\Npm;

use Gear\Diagnostic\NpmServiceFactory;

trait NpmServiceTrait
{
    protected $npmService;

    public function getNpmService()
    {
        return $this->npmService;
    }

    public function setNpmService(
        NpmService $npmService
    ) {
        $this->npmService = $npmService;
        return $this;
    }
}
