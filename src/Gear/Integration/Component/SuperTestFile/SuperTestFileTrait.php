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
        if (!isset($this->superTestFile)) {
            $name = 'Gear\Integration\Component\SuperTestFile\SuperTestFile';
            $this->superTestFile = $this->getServiceLocator()->get($name);
        }
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
