<?php
namespace Gear\Integration\Suite\Src\SrcSuite;

use Gear\Integration\Suite\Src\SrcGenerator\SrcGeneratorTrait;
use Gear\Integration\Component\SuperTestFile\SuperTestFileTrait;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\Src\SrcMinorSuite;
use Gear\Integration\Suite\Src\SrcMajorSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/Src/SrcSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcSuite
{
    use SrcGeneratorTrait;
    use SuperTestFileTrait;

    /**
     * Constructor
     *
     * @param SrcGenerator  $srcGenerator  Src Generator
     * @param SuperTestFile $superTestFile Super Test File
     *
     * @return \Gear\Integration\Suite\Src\SrcSuite\SrcSuite
     */
    public function __construct(
        SrcGenerator $srcGenerator,
        SuperTestFile $superTestFile
    ) {
        $this->srcGenerator = $srcGenerator;
        $this->superTestFile = $superTestFile;

        return $this;
    }


    public function runSrcSuite($types, $repeat)
    {
        $srcMajor = new SrcMajorSuite();

        echo '    - Create Src Suite'."\n";

        foreach ($types as $type) {
            $srcMajor->addMinorSuite($this->srcGenerator->generateMinorSuite(new SrcMinorSuite($srcMajor, $type, $repeat)));
        }

        $this->superTestFile->updateSuperTestFile($srcMajor);


        echo '    - Finish.'."\n\n";
    }

}
