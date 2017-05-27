<?php
namespace Gear\UserType\Feature;

class All implements UserTypeFeatureInterface
{
    const EXPECTED_COUNT_ON_LIST = 10;

    public function getExpectedCountOnList()
    {
        return self::EXPECTED_COUNT_ON_LIST;
    }
}
