<?php
namespace Gear\UserType\Service;

use Gear\UserType\Service\UserTypeServiceInterface;

class Strict implements UserTypeServiceInterface
{
    public function getServiceSelectById($repository, $label = null, $entity = null)
    {

        return <<<EOS
    public function selectById(\$idToSelect)
    {
        \$repository = \$this->get{$repository}();

        \$entity = \$repository->selectById(\$idToSelect);

        if (!\$this->zfcuserAuthService->hasIdentity() || !\$entity) {
            return null;
        }

        if (\$entity->getCreatedBy()->getIdUser() === \$this->zfcuserAuthService->getIdentity()->getIdUser()) {
            return \$entity;
        }

        return null;
    }

EOS;
    }

    public function getServiceSelectAll()
    {
        return <<<EOS
        if (\$this->zfcuserAuthService->hasIdentity()) {
            \$select = array_merge(\$select, array('createdBy' => \$this->zfcuserAuthService->getIdentity()->getId()));
        }
        return parent::selectAll(\$select);

EOS;
    }

    public function getServiceSelectViewById($repository)
    {
        return '';
    }
}
