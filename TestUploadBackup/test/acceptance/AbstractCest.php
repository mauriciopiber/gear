<?php
namespace TestUpload\Acceptance;

use TestUpload\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 */
class AbstractCest
{
// @codingStandardsIgnoreStart
    public function _before(AcceptanceTester $I)
    {
// @codingStandardsIgnoreEnd
        \TestUpload\LoginCommons::logMeIn($I);
    }

// @codingStandardsIgnoreStart
    public function _after(AcceptanceTester $I)
    {
// @codingStandardsIgnoreEnd
        \TestUpload\LoginCommons::logMeOut($I);
    }
}
