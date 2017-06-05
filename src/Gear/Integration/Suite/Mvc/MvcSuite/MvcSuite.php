<?php
namespace Gear\Integration\Suite\Mvc\MvcSuite;

use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGeneratorTrait;
use Gear\Integration\Component\SuperTestFile\SuperTestFileTrait;
use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/Mvc/MvcSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class MvcSuite
{
    use MvcGeneratorTrait;
    use SuperTestFileTrait;

    /**
     * Constructor
     *
     * @param MvcGenerator  $mvcGenerator  Mvc Generator
     * @param SuperTestFile $superTestFile Super Test File
     *
     * @return \Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite
     */
    public function __construct(
        MvcGenerator $mvcGenerator,
        SuperTestFile $superTestFile
    ) {
        $this->mvcGenerator = $mvcGenerator;
        $this->superTestFile = $superTestFile;

        return $this;
    }

    public function runMvcSuite(
        $suiteName,
        $suiteColumns,
        $suiteUserTypes,
        $suiteConstraints,
        $suiteTables,
        $longname = false
    ) {
         echo '    - Create Mvc Suite'."\n";

        $mvcMajor = new MvcMajorSuite($suiteName, $suiteColumns, $suiteUserTypes, $suiteConstraints, $suiteTables);

        $tables = $mvcMajor->getTables();

        foreach ($tables as $tableInfo) {
            list($column, $userType, $constraint, $tableAssoc) = $tableInfo;

            $mvcSuite = new MvcMinorSuite(
                $mvcMajor,
                $column,
                $userType,
                $constraint,
                $tableAssoc,
                $longname
            );

            $mvcMajor->addMinorSuite($this->mvcGenerator->generateMvc($mvcSuite));
        }

        $this->superTestFile->updateSuperTestFile($mvcMajor);

        echo '    - Finish.'."\n\n";
    }

    public function runMinSuite($longname = false)
    {
        $this->runMvcSuite(
            'mvc-columns',
            [
                'mvc-basic',
            ***REMOVED***,
            ['all'***REMOVED***,
            [null***REMOVED***,
            [null***REMOVED***,
            $longname
        );
    }

    public function runSuite($longname = false)
    {
        //columns
        $this->runMvcSuite(
            'mvc-columns',
            [
                'mvc-complete',
                'mvc-basic',
                'mvc-varchar',
                'mvc-dates',
                'mvc-text',
                'mvc-numeric'
            ***REMOVED***,
            ['all'***REMOVED***,
            [null***REMOVED***,
            [null***REMOVED***,
            $longname
        );


        //usertype
        $this->runMvcSuite(
            'mvc-usertypes',
            [
                'mvc-basic',
            ***REMOVED***,
            ['low-strict', 'strict'***REMOVED***,
            [null***REMOVED***,
            [null***REMOVED***,
            $longname
        );

        //constraints
        $this->runMvcSuite(
            'mvc-constraints',
            [
                'mvc-basic',
            ***REMOVED***,
            ['all'***REMOVED***,
            [['nullable'***REMOVED***, ['unique'***REMOVED***, ['nullable', 'unique'***REMOVED******REMOVED***,
            [null***REMOVED***,
            $longname
        );

        //constraints
        $this->runMvcSuite(
            'mvc-upload-image',
            [
                'mvc-basic',
            ***REMOVED***,
            ['all'***REMOVED***,
            [null***REMOVED***,
            ['upload_image'***REMOVED***,
            $longname
        );

        //complete
        //constraints
        $this->runMvcSuite(
            'mvc-complete',
            [
                'mvc-complete',
            ***REMOVED***,
            ['strict'***REMOVED***,
            [['unique', 'nullable'***REMOVED******REMOVED***,
            ['upload_image'***REMOVED***,
            false
        );
    }
}
