<?php
namespace FunctionalTester;

class AbstractCest
{
    public function _before(\FunctionalTester $I)
    {
        \TesteTest\LoginCommons::logMeIn($I);
    }

    public function _after(\FunctionalTester $I)
    {
        \TesteTest\LoginCommons::logMeOut($I);
    }
}