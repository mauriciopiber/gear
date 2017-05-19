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

    public function runMvcSuite($suiteName, $suiteColumns, $suiteUserTypes, $suiteConstraints, $suiteTables)
    {
        $expectedColumns = [
            $suiteName => $suiteColumns,
        ***REMOVED***;

        $configColumns = [
            'usertype' => $suiteUserTypes,
            'constraints' => $suiteConstraints,
            'tables' => $suiteTables
        ***REMOVED***;

        echo '    - Create Mvc Suite'."\n";

        $mvcMajor = new MvcMajorSuite($suiteName);

        foreach ($expectedColumns as $columnType) {
            foreach ($columnType as $column) {
                foreach ($configColumns['usertype'***REMOVED*** as $userType) {
                    foreach ($configColumns['constraints'***REMOVED*** as $constraint) {
                        foreach ($configColumns['tables'***REMOVED*** as $tables) {

                            $mvcSuite = new MvcMinorSuite(
                                $mvcMajor,
                                $column,
                                $userType,
                                $constraint,
                                $tables
                            );
                            $mvcMajor->addMinorSuite($this->mvcGenerator->generateMvc($mvcSuite));
                        }
                    }
                }

            }

            $this->superTestFile->updateSuperTestFile($mvcMajor);
        }

        echo '    - Finish.'."\n\n";
    }


    public function runSuite()
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
            [null***REMOVED***
        );


        //usertype
        $this->runMvcSuite(
            'mvc-usertypes',
            [
                'mvc-basic',
            ***REMOVED***,
            ['low-strict', 'strict'***REMOVED***,
            [null***REMOVED***,
            [null***REMOVED***
        );

        //constraints
        $this->runMvcSuite(
            'mvc-constraints',
            [
                'mvc-basic',
            ***REMOVED***,
            ['all'***REMOVED***,
            [['nullable'***REMOVED***, ['unique'***REMOVED***, ['nullable', 'unique'***REMOVED******REMOVED***,
            [null***REMOVED***
        );

        //constraints
        $this->runMvcSuite(
            'mvc-upload-image',
            [
                'mvc-basic',
            ***REMOVED***,
            ['all'***REMOVED***,
            [null***REMOVED***,
            ['upload_image'***REMOVED***
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
            ['upload_image'***REMOVED***
        );
    }
}
