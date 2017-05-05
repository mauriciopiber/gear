<?php
namespace Gear\Integration\Suite\Controller\ControllerGenerator;

use Gear\Integration\Component\GearFile\GearFileTrait;
use Gear\Integration\Component\TestFile\TestFileTrait;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/Controller/ControllerGenerator
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerGenerator
{
    use GearFileTrait;
    use TestFileTrait;

    /**
     * Constructor
     *
     * @param GearFile $gearFile Gear File
     * @param TestFile $testFile Test File
     *
     * @return \Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator
     */
    public function __construct(
        GearFile $gearFile,
        TestFile $testFile
    ) {
        $this->gearFile = $gearFile;
        $this->testFile = $testFile;

        return $this;
    }

    public function generateMinorSuite(ControllerMinorSuite $suite)
    {
        $type = $suite->getType();
        $repeat = $suite->getRepeat();

        $srcs = [***REMOVED***;
        $srcs = $this->createPrepareController($type, $repeat);

        $controllers = [***REMOVED***;
        $controllers[***REMOVED*** = $this->createSuite($type, $repeat);

        $suite->setLocationKey(sprintf('controller-%s', strtolower($suite->getType())));

        $gearfile = $this->gearFile->createControllerGearFile($suite, ['src' => $srcs, 'controller' => $controllers***REMOVED***);

        echo sprintf('        - minor: %s', $type)."\n";

        return $gearfile;
    }

    private function createPrepareController($type, $repeat)
    {
        $implements = [***REMOVED***;
        $implements[***REMOVED*** = [
            'name' => '%sImpl%s%s',
            'type' => 'Interface'
        ***REMOVED***;

        $interfaces = [$implements, ['0' => ''***REMOVED***, $type, $repeat***REMOVED***;


        $invokables = [***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => '%sExtendable%s%s',
            'type' => $type
        ***REMOVED***;

        $extends = [$invokables, ['invokables', 'factories'***REMOVED***, $type, $repeat***REMOVED***;


        return [$interfaces, $extends***REMOVED***;
    }

    private function createSuite($type, $repeat)
    {

        $invokables[***REMOVED*** = [
            'name' => '%s%s%s',
            'type' => $type
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => '%sNamespace%s%s',
            'type' => $type,
            'namespace' => '%s'
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => '%sImplements%s%s',
            'implements' => $this->gearFile->createMultiplesInterfaces($type, 1),
            'type' => $type
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => '%sImplementsMany%s%s',
            'implements' => $this->gearFile->createMultiplesInterfaces($type, $repeat),
            'type' => $type
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => '%sExtends%s%s',
            'extends' => '%s\%sExtendable%s%s',
            'type' => $type
        ***REMOVED***;

        return [$invokables, ['invokables', 'factories'***REMOVED***, $type, $repeat***REMOVED***;
    }

    function createDepSuite()
    {
        return [***REMOVED***;
    }
}
