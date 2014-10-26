<?php
namespace Gear\Common;

trait AclServiceTrait {

    protected $aclService;

    public function setAclService($aclService)
    {
        $this->aclService = $aclService;
    }

    public function getAclService()
    {
        if (!isset($this->aclService)) {
            $this->aclService = $this->getServiceLocator()->get('aclService');
        }
        return $this->aclService;
    }
}