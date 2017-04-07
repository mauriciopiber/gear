<?php
namespace Gear\UserType;

interface UserTypeServiceTestInterface
{
    public function renderSelectByIdNull();

    public function renderDelete(array $options);

    public function renderSelectViewById(array $options);

    public function renderSelectById(array $options);

    public function renderSelectAll(array $options);

    public function renderSelectByIdReturnInvalid(array $options);
}
