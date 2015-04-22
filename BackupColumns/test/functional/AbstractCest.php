<?php
namespace Column\Functional;

use Column\FunctionalTester;

/**
 * @SuppressWarnings(PHPMD)
 */
class AbstractCest
{
// @codingStandardsIgnoreStart
    public function _before(FunctionalTester $I)
    {
// @codingStandardsIgnoreEnd
        \Column\LoginCommons::logMeIn($I);
    }

// @codingStandardsIgnoreStart
    public function _after(FunctionalTester $I)
    {
// @codingStandardsIgnoreEnd
        \Column\LoginCommons::logMeOut($I);
    }
}
