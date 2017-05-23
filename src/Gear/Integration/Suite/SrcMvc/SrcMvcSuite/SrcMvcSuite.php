<?php
namespace Gear\Integration\Suite\SrcMvc\SrcMvcSuite;

use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGeneratorTrait;
use Gear\Integration\Component\SuperTestFile\SuperTestFileTrait;
use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/SrcMvc/SrcMvcSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcMvcSuite
{
    use SrcMvcGeneratorTrait;
    use SuperTestFileTrait;

    /**
     * Constructor
     *
     * @param SrcMvcGenerator $srcMvcGenerator Src Mvc Generator
     * @param SuperTestFile   $superTestFile   Super Test File
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite
     */
    public function __construct(
        SrcMvcGenerator $srcMvcGenerator,
        SuperTestFile $superTestFile
    ) {
        $this->srcMvcGenerator = $srcMvcGenerator;
        $this->superTestFile = $superTestFile;

        return $this;
    }

    public function runSrcMvcSuite(
        $types,
        $suiteColumns,
        $suiteUserTypes,
        $suiteConstraints,
        $suiteTables,
        $longname = false
    ) {
        echo '    - Create Src Mvc Suite'."\n";

        $srcMvcMajor = new SrcMvcMajorSuite(
            $suiteColumns,
            $suiteUserTypes,
            $suiteConstraints,
            $suiteTables
        );

        foreach ($types as $type) {
            $srcMvcMinor = new SrcMvcMinorSuite($srcMvcMajor, $type, null, null, null, null, $longname);
            $srcMvcMajor->addMinorSuite($this->srcMvcGenerator->generateSrcMvc($srcMvcMinor));
        }

        $this->superTestFile->updateSuperTestFile($srcMvcMajor);

        echo '    - Finish.'."\n\n";
    }
}
