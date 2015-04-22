<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 */
class AbstractCest
{
// @codingStandardsIgnoreStart
    public function _before(AcceptanceTester $I)
    {
// @codingStandardsIgnoreEnd
        \Column\LoginCommons::logMeIn($I);
    }

// @codingStandardsIgnoreStart
    public function _after(AcceptanceTester $I)
    {
// @codingStandardsIgnoreEnd
        \Column\LoginCommons::logMeOut($I);
    }
}
