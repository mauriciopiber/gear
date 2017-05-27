<?php
namespace Gear\UserType\Feature;

interface UserTypeFeatureInterface
{
    public function getExpectedCountOnList();

    public function getPaginator();

    public function getTotalPage();

    public function getFilterIterator();
}
