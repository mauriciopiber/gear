<?php
namespace Gear\UserType\ControllerTest;

class Strict implements UserTypeControllerTestInterface
{
    public function getMockZfcAuthenticate()
    {
        return '';
    }
}
