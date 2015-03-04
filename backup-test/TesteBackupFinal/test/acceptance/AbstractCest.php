<?php
namespace AcceptanceTester;

class AbstractCest
{
    public function _before(\AcceptanceTester $I)
    {
        \TesteTest\LoginCommons::logMeIn($I);
    }

    public function _after(\AcceptanceTester $I)
    {
        \TesteTest\LoginCommons::logMeOut($I);
    }
}