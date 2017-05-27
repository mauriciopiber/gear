<?php
namespace Gear\UserType\Feature;

class Strict implements UserTypeFeatureInterface
{
    const EXPECTED_COUNT_ON_LIST = 6;

    public function getExpectedCountOnList()
    {
        return self::EXPECTED_COUNT_ON_LIST;
    }
}
