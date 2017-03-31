<?php
namespace Gear\UserType;

class Strict
{
    public function getServiceSelectById($repository)
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

    public function getFixtureUse()
    {
        return <<<EOS
use GearBase\Fixture\UserChooseTrait;

EOS;
    }

    public function getFixtureAttribute()
    {
        return <<<EOS
    use UserChooseTrait;

EOS;
    }
}
