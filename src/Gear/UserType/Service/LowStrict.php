<?php
namespace Gear\UserType\Service;

use Gear\UserType\Service\UserTypeServiceInterface;

class LowStrict implements UserTypeServiceInterface
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
        \$data = parent::selectAll(\$select);

        if (count(\$data) === 0) {
            return \$data;
        }

        foreach (\$data as \$i => \$item) {
            \$data[\$i***REMOVED***['user'***REMOVED*** = \$item['createdBy'***REMOVED***['idUser'***REMOVED***;
        }

        return \$data;

EOS;
    }

    public function getServiceSelectViewById($repository)
    {
        return <<<EOS

    public function selectViewById(\$idToSelect)
    {
        \$entity = \$this->get{$repository}()->selectById(\$idToSelect);
        return \$entity;
    }

EOS;
    }
}
