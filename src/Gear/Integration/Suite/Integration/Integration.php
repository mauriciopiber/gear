<?php
namespace Gear\Integration\Suite\Integration;

use Gear\Integration\Suite\Src\SrcSuite\SrcSuiteTrait;
use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuiteTrait;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuiteTrait;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuiteTrait;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuiteTrait;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/Integration
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class Integration
{
    use SrcSuiteTrait;

    use SrcMvcSuiteTrait;

    use ControllerSuiteTrait;

    use ControllerMvcSuiteTrait;

    use MvcSuiteTrait;

    const ALL_COLUMNS = ['basic', 'complete'***REMOVED***;

    const ALL_CONSTRAINTS = [null, ['unique'***REMOVED***, ['nullable'***REMOVED***, ['unique', 'nullable'***REMOVED******REMOVED***;

    const ALL_USERTYPES = ['all', 'low-strict', 'strict'***REMOVED***;

    const ALL_ASSOC_TABLES = [null, 'upload_image'***REMOVED***;

    const REPEAT = 4;

    /**
     * Constructor
     *
     * @param SrcSuite           $srcSuite           Src Suite
     * @param SrcMvcSuite        $srcMvcSuite        Src Mvc Suite
     * @param ControllerSuite    $controllerSuite    Controller Suite
     * @param ControllerMvcSuite $controllerMvcSuite Controller Mvc Suite
     * @param MvcSuite           $mvcSuite           Mvc Suite
     *
     * @return \Gear\Integration\Suite\Integration\Integration
     */
    public function __construct(
        SrcSuite $srcSuite,
        SrcMvcSuite $srcMvcSuite,
        ControllerSuite $controllerSuite,
        ControllerMvcSuite $controllerMvcSuite,
        MvcSuite $mvcSuite
    ) {
        $this->srcSuite = $srcSuite;
        $this->srcMvcSuite = $srcMvcSuite;
        $this->controllerSuite = $controllerSuite;
        $this->controllerMvcSuite = $controllerMvcSuite;
        $this->mvcSuite = $mvcSuite;

        return $this;
    }

    public function integrate()
    {
        //$this->runSrc();
        //$this->runController();
        //$this->runSrcMvc();
        $this->runControllerMvc();
        //$this->runMvc();

        echo 'Integrate'."\n";
    }

    public function runSrc()
    {
        $this->srcSuite->runSrcSuite(
            [
                'repository',
                'service',
                'form',
                'filter',
                'view-helper',
                'controller-plugin',
                'value-object'
            ***REMOVED***,
            self::REPEAT
        );
    }

    public function runMvc()
    {
        //columns
        $this->mvcSuite->runMvcSuite(
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
        $this->mvcSuite->runMvcSuite(
            'mvc-usertypes',
            [
                'mvc-basic',
            ***REMOVED***,
            ['low-strict', 'strict'***REMOVED***,
            [null***REMOVED***,
            [null***REMOVED***
        );

        //constraints
        $this->mvcSuite->runMvcSuite(
            'mvc-constraints',
            [
                'mvc-basic',
            ***REMOVED***,
            ['all'***REMOVED***,
            [['nullable'***REMOVED***, ['unique'***REMOVED***, ['nullable', 'unique'***REMOVED******REMOVED***,
            [null***REMOVED***
        );

        //constraints
        $this->mvcSuite->runMvcSuite(
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
        $this->mvcSuite->runMvcSuite(
            'mvc-complete',
            [
                'mvc-complete',
            ***REMOVED***,
            ['strict'***REMOVED***,
            [['unique', 'nullable'***REMOVED******REMOVED***,
            ['upload_image'***REMOVED***
        );
    }

    public function runController()
    {
        $this->controllerSuite->runControllerSuite(['action', 'console'***REMOVED***, self::REPEAT);
    }

    public function runControllerMvc()
    {
        $this->controllerMvcSuite->runControllerMvcSuite(
            self::ALL_COLUMNS,
            self::ALL_USERTYPES,
            self::ALL_CONSTRAINTS,
            self::ALL_ASSOC_TABLES
        );
    }

    public function runSrcMvc()
    {

        $this->srcMvcSuite->runSrcMvcSuite(
            [
                'entity',
                'fixture',
                'repository',
                'service',
                'filter',
                'form',
                'search-form'
            ***REMOVED***,
            self::ALL_COLUMNS,
            self::ALL_USERTYPES,
            self::ALL_CONSTRAINTS,
            self::ALL_ASSOC_TABLES
        );
    }

}
