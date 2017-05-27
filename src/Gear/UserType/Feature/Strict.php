<?php
namespace Gear\UserType\Feature;

class Strict implements UserTypeFeatureInterface
{
    const EXPECTED_COUNT_ON_LIST = 6;

    const PAGINATOR = '1 - 5 de 5';

    const TOTAL_PAGE = 5;

    const FILTER_ITERATOR = 12;

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
