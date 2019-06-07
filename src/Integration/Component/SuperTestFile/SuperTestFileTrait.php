<?php
namespace Gear\Integration\Component\SuperTestFile;

use Gear\Integration\Component\SuperTestFile\SuperTestFileFactory;

trait SuperTestFileTrait
{
    protected $superTestFile;

    /**
     * Get Super Test File
     *
     * @return Gear\Integration\Component\SuperTestFile\SuperTestFile
     */
    public function getSuperTestFile()
    {
        return $this->superTestFile;
    }

    /**
     * Set Super Test File
     *
     * @param SuperTestFile $superTestFile Super Test File
     *
     * @return \Gear\Integration\Component\SuperTestFile\SuperTestFile
     */
    public function setSuperTestFile(
        SuperTestFile $superTestFile
    ) {
        $this->superTestFile = $superTestFile;
        return $this;
    }
}
