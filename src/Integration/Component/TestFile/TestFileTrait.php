<?php
namespace Gear\Integration\Component\TestFile;

use Gear\Integration\Component\TestFile\TestFileFactory;

trait TestFileTrait
{
    protected $testFile;

    /**
     * Get Test File
     *
     * @return Gear\Integration\Component\TestFile\TestFile
     */
    public function getTestFile()
    {
        return $this->testFile;
    }

    /**
     * Set Test File
     *
     * @param TestFile $testFile Test File
     *
     * @return \Gear\Integration\Component\TestFile\TestFile
     */
    public function setTestFile(
        TestFile $testFile
    ) {
        $this->testFile = $testFile;
        return $this;
    }
}
