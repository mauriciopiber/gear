<?php
namespace Gear\UserType\Feature;

class All implements UserTypeFeatureInterface
{
    const EXPECTED_COUNT_ON_LIST = 10;

    const PAGINATOR = '1 - 10 de 30';

    const TOTAL_PAGE = 10;

    const FILTER_ITERATOR = 21;

    public function getFilterIterator()
    {
        return self::FILTER_ITERATOR;
    }

    public function getTotalPage()
    {
        return self::TOTAL_PAGE;
    }

    public function getPaginator()
    {
        return self::PAGINATOR;
    }

    public function getExpectedCountOnList()
    {
        return self::EXPECTED_COUNT_ON_LIST;
    }
}
