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
use Gear\Integration\Suite\Integration\Exception\InvalidTypeException;
use Gear\Integration\Suite\Integration\Exception\InvalidMaxCountException;
use GearJson\Src\SrcTypesInterface;
use GearJson\Controller\ControllerTypesInterface;

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

    const TYPES = [
        self::CONTROLLER,
        self::CONTROLLER_MVC,
        self::SRC,
        self::SRC_MVC,
        self::MVC
    ***REMOVED***;

    const CONTROLLER_MVC = 'controller-mvc';

    const CONTROLLER = 'controller';

    const SRC = 'src';

    const SRC_MVC = 'src-mvc';

    const MVC = 'mvc';

    const MAX_COUNT = 10;

    protected $type;

    protected $count;

    protected $longname = false;

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

    public function validate()
    {
        if ($this->type !== null && !in_array($this->type, self::TYPES)) {
            throw new InvalidTypeException($this->type);
        }

        if ($this->count <= 0 || $this->count > self::MAX_COUNT) {
            throw new InvalidMaxCountException($this->count);
        }
    }

    public function integrate($type, $count, $longname = false, $min = false)
    {
        $this->type = $type;
        $this->count = $count;
        $this->longname = $longname;
        $this->min = $min;

        $this->validate();

        if ($this->min) {
            echo 'Integrate Min'."\n";
            $this->runMin();
            echo 'Integrate Min Complete'."\n";
            return;
        }

        echo 'Integrate'."\n";

        $this->runMvc();
        $this->runSrc();
        $this->runController();

        echo 'Integrate complete'."\n";
    }

    public function runMin()
    {
        $this->srcMvcSuite->runSrcMvcSuite(
            [
                SrcTypesInterface::ENTITY,
                SrcTypesInterface::FIXTURE,
                SrcTypesInterface::REPOSITORY,
                SrcTypesInterface::SERVICE,
                SrcTypesInterface::FILTER,
                SrcTypesInterface::FORM,
                SrcTypesInterface::SEARCH_FORM
            ***REMOVED***,
            ['basic'***REMOVED***,
            ['all'***REMOVED***,
            [null***REMOVED***,
            [null***REMOVED***,
            true
        );

        $this->mvcSuite->runMinSuite($this->longname);

        $this->srcSuite->runSrcSuite(
            [
                SrcTypesInterface::REPOSITORY,
                SrcTypesInterface::SERVICE,
                SrcTypesInterface::FORM,
                SrcTypesInterface::FILTER,
                SrcTypesInterface::VIEW_HELPER,
                SrcTypesInterface::CONTROLLER_PLUGIN,
                SrcTypesInterface::VALUE_OBJECT
            ***REMOVED***,
            1,
            true
        );

        $this->controllerSuite->runControllerSuite([ControllerTypesInterface::ACTION, ControllerTypesInterface::CONSOLE***REMOVED***, 1, true);

        $this->controllerMvcSuite->runControllerMvcSuite(
            ['basic'***REMOVED***,
            ['all'***REMOVED***,
            [null***REMOVED***,
            [null***REMOVED***,
            true
        );
    }

    public function runMvc()
    {
        if ($this->type === null || $this->type == self::MVC) {
            $this->mvcSuite->runSuite($this->longname);
        }

        if ($this->type === null || $this->type == self::SRC_MVC) {
            $this->runSrcMvc();
        }

        if ($this->type === null || $this->type == self::CONTROLLER_MVC) {
            $this->runControllerMvc();
        }
    }

    public function runSrc()
    {
        if ($this->type === null || $this->type == self::SRC) {
            $this->srcSuite->runSrcSuite(
                [
                    SrcTypesInterface::INTERFACE,
                    SrcTypesInterface::REPOSITORY,
                    SrcTypesInterface::SERVICE,
                    SrcTypesInterface::FORM,
                    SrcTypesInterface::FILTER,
                    SrcTypesInterface::VIEW_HELPER,
                    SrcTypesInterface::CONTROLLER_PLUGIN,
                    SrcTypesInterface::VALUE_OBJECT
                ***REMOVED***,
                $this->count,
                $this->longname
            );
        }
    }

    public function runController()
    {
        if ($this->type === null || $this->type == self::CONTROLLER) {
            $this->controllerSuite->runControllerSuite(['action', 'console', 'rest'***REMOVED***, $this->count, $this->longname);
        }
    }


    public function runControllerMvc()
    {
        $this->controllerMvcSuite->runControllerMvcSuite(
            self::ALL_COLUMNS,
            self::ALL_USERTYPES,
            self::ALL_CONSTRAINTS,
            self::ALL_ASSOC_TABLES,
            $this->longname
        );
    }

    public function runSrcMvc()
    {

        $this->srcMvcSuite->runSrcMvcSuite(
            [
                SrcTypesInterface::ENTITY,
                SrcTypesInterface::FIXTURE,
                SrcTypesInterface::REPOSITORY,
                SrcTypesInterface::SERVICE,
                SrcTypesInterface::FILTER,
                SrcTypesInterface::FORM,
                SrcTypesInterface::SEARCH_FORM
            ***REMOVED***,
            self::ALL_COLUMNS,
            self::ALL_USERTYPES,
            self::ALL_CONSTRAINTS,
            self::ALL_ASSOC_TABLES,
            $this->longname
        );
    }
}
