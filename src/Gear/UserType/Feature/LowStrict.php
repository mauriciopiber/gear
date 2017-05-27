<?php
namespace Gear\UserType\Feature;

class LowStrict implements UserTypeFeatureInterface
{
    const EXPECTED_COUNT_ON_LIST = 10;

    public function getExpectedCountOnList()
    {
        return self::EXPECTED_COUNT_ON_LIST;
    }
}
