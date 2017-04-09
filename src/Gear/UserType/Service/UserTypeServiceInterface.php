<?php
namespace Gear\UserType\Service;

interface UserTypeServiceInterface
{
    public function getServiceSelectById($repository, $label = null, $entity = null);

    public function getServiceSelectAll();

    public function getServiceSelectViewById($repository);
}
