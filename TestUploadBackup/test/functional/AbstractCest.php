<?php
namespace TestUpload\Functional;

use TestUpload\FunctionalTester;

/**
 * @SuppressWarnings(PHPMD)
 */
class AbstractCest
{
// @codingStandardsIgnoreStart
    public function _before(FunctionalTester $I)
    {
// @codingStandardsIgnoreEnd
        \TestUpload\LoginCommons::logMeIn($I);
    }

// @codingStandardsIgnoreStart
    public function _after(FunctionalTester $I)
    {
// @codingStandardsIgnoreEnd
        \TestUpload\LoginCommons::logMeOut($I);
    }
}
