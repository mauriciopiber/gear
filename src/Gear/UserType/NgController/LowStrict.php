<?php
namespace Gear\UserType\NgController;

class LowStrict implements UserTypeNgControllerInterface
{
    public function getUserIdList()
    {
        return PHP_EOL.'        vm.id                    = id;'.PHP_EOL;
    }
}
