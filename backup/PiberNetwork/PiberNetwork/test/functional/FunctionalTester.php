<?php
//[STAMP***REMOVED*** 0e0fa45056260ce670935af1a7a87881

// This class was automatically generated by build task
// You should not change it manually as it will be overwritten on next build
// @codingStandardsIgnoreFile


use Codeception\Module\Filesystem;
use Codeception\Module\FunctionalHelper;
use Codeception\Module\WebDriver;
use Codeception\Module\Db;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void haveFriend($name)
 * @SuppressWarnings(PHPMD)
*/
class FunctionalTester extends \PiberNetwork\GuyTester
{

    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Enters a directory In local filesystem.
     * Project root directory is used by default
     *
     * @param $path
     * @see \Codeception\Module\Filesystem::amInPath()
     */
    public function amInPath($path) {
        return $this->scenario->runStep(new \Codeception\Step\Condition('amInPath', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Opens a file and stores it's content.

     * @param $filename
     * @see \Codeception\Module\Filesystem::openFile()
     */
    public function openFile($filename) {
        return $this->scenario->runStep(new \Codeception\Step\Action('openFile', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.

     *
     * @param $filename
     * @see \Codeception\Module\Filesystem::deleteFile()
     */
    public function deleteFile($filename) {
        return $this->scenario->runStep(new \Codeception\Step\Action('deleteFile', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Deletes directory with all subdirectories
``
     *
     * @param $dirname
     * @see \Codeception\Module\Filesystem::deleteDir()
     */
    public function deleteDir($dirname) {
        return $this->scenario->runStep(new \Codeception\Step\Action('deleteDir', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Copies directory with all contents

     *
     * @param $src
     * @param $dst
     * @see \Codeception\Module\Filesystem::copyDir()
     */
    public function copyDir($src, $dst) {
        return $this->scenario->runStep(new \Codeception\Step\Action('copyDir', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Checks If opened file has `text` in it.
`
     *
     * @param $text
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Filesystem::seeInThisFile()
     */
    public function canSeeInThisFile($text) {
        return $this->scenario->runStep(new \Codeception\Step\ConditionalAssertion('seeInThisFile', func_get_args()));
    }
    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Checks If opened file has `text` in it.
     *
     * Usage:

     *
     * @param $text
     * @see \Codeception\Module\Filesystem::seeInThisFile()
     */
    public function seeInThisFile($text) {
        return $this->scenario->runStep(new \Codeception\Step\Assertion('seeInThisFile', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Checks the strict matching of file contents.
     * Unlike `seeInThisFile` will fail if file has something more than expected lines.

     * ```
     *
     * @param $text
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Filesystem::seeFileContentsEqual()
     */
    public function canSeeFileContentsEqual($text) {
        return $this->scenario->runStep(new \Codeception\Step\ConditionalAssertion('seeFileContentsEqual', func_get_args()));
    }
    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Checks the strict matching of file contents.
     * Unlike `seeInThisFile` will fail if file has something more than expected lines.
     * Better to use with HEREDOC strings.
     * Matching is done after removing "\r" chars from file content.

     *
     * @param $text
     * @see \Codeception\Module\Filesystem::seeFileContentsEqual()
     */
    public function seeFileContentsEqual($text) {
        return $this->scenario->runStep(new \Codeception\Step\Assertion('seeFileContentsEqual', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Checks If opened file doesn't contain `text` in it

     *
     * @param $text
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Filesystem::dontSeeInThisFile()
     */
    public function cantSeeInThisFile($text) {
        return $this->scenario->runStep(new \Codeception\Step\ConditionalAssertion('dontSeeInThisFile', func_get_args()));
    }
    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *

     *
     * @param $text
     * @see \Codeception\Module\Filesystem::dontSeeInThisFile()
     */
    public function dontSeeInThisFile($text) {
        return $this->scenario->runStep(new \Codeception\Step\Assertion('dontSeeInThisFile', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Deletes a file
     * @see \Codeception\Module\Filesystem::deleteThisFile()
     */
    public function deleteThisFile() {
        return $this->scenario->runStep(new \Codeception\Step\Action('deleteThisFile', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Checks if file exists in path.
     * Opens a file when it's exists
     *
     * ``` php

     *
     * @param $filename
     * @param string $path
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Filesystem::seeFileFound()
     */
    public function canSeeFileFound($filename, $path = null) {
        return $this->scenario->runStep(new \Codeception\Step\ConditionalAssertion('seeFileFound', func_get_args()));
    }
    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Checks if file exists in path.
     * Opens a file when it's exists

     * @param $filename
     * @param string $path
     * @see \Codeception\Module\Filesystem::seeFileFound()
     */
    public function seeFileFound($filename, $path = null) {
        return $this->scenario->runStep(new \Codeception\Step\Assertion('seeFileFound', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Checks if file does not exists in path
     *
     * @param $filename
     * @param string $path
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Filesystem::dontSeeFileFound()
     */
    public function cantSeeFileFound($filename, $path = null) {
        return $this->scenario->runStep(new \Codeception\Step\ConditionalAssertion('dontSeeFileFound', func_get_args()));
    }
    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Checks if file does not exists in path
     *
     * @param $filename
     * @param string $path
     * @see \Codeception\Module\Filesystem::dontSeeFileFound()
     */
    public function dontSeeFileFound($filename, $path = null) {
        return $this->scenario->runStep(new \Codeception\Step\Assertion('dontSeeFileFound', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * ```
     *
     * @param $dirname
     * @see \Codeception\Module\Filesystem::cleanDir()
     */
    public function cleanDir($dirname) {
        return $this->scenario->runStep(new \Codeception\Step\Action('cleanDir', func_get_args()));
    }


    /**
     * [!***REMOVED*** Method is generated. Documentation taken from corresponding module.
     *
     * Saves contents to file
     *
     * @param $filename
     * @param $contents
     * @see \Codeception\Module\Filesystem::writeToFile()
     */
    public function writeToFile($filename, $contents) {
        return $this->scenario->runStep(new \Codeception\Step\Action('writeToFile', func_get_args()));
    }
}
