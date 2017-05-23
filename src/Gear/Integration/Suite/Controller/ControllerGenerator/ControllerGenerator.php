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

    const INTERFACE = 'interface';

    const REPOSITORY = 'repository';

    const SERVICE = 'service';

    const FORM = 'form';

    const FILTER = 'filter';


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
        $this->suite = $suite;

        $this->type = $suite->getType();
        $this->repeat = $suite->getRepeat();

        $this->keyStyle = ($suite->isUsingLongName()) ? 'long' : 'short';

        $srcs = [***REMOVED***;
        $srcs[***REMOVED*** = $this->createPrepareInterface();
        $srcs[***REMOVED*** = $this->createPrepareDependency();


        $controllers = [***REMOVED***;
        $controllers[***REMOVED*** = $this->createPrepareExtends();
        $controllers[***REMOVED*** = $this->createControllers();


        //gearfile
        $gearfile = $this->gearFile->createControllerGearFile($suite, ['src' => $srcs, 'controller' => $controllers***REMOVED***);

        //testfile
        $suite->setGearFile($gearfile);
        $this->testFile->updateTestFile($suite);

        echo sprintf('        - minor: %s', $this->type)."\n";

        return $gearfile;
    }

    private function createPrepareExtends()
    {
        $invokables = [***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type
        ***REMOVED***;

        return [$invokables, ['invokables', 'factories'***REMOVED***, $this->type, $this->repeat***REMOVED***;
    }

    private function createControllers()
    {
        $invokables = [***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            'actions' => [***REMOVED***
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['namespace'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            'namespace' => '%s',
            'actions' => [***REMOVED***
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'extends' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            'actions' => [***REMOVED***
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['implements'***REMOVED***[$this->keyStyle***REMOVED***,
            'implements' => $this->gearFile->createMultiplesImplements(
                $this->suite,
                $this->type,
                1,
                $this->repeat,
                $this->keyStyle
            ),
            'type' => $this->type,
            'actions' => [***REMOVED***
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['implements-many'***REMOVED***[$this->keyStyle***REMOVED***,
            'implements' => $this->gearFile->createMultiplesImplements(
                $this->suite,
                $this->type,
                $this->repeat,
                $this->repeat,
                $this->keyStyle
            ),
            'type' => $this->type,
            'actions' => [***REMOVED***
        ***REMOVED***;


        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['dependency'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            'dependency' => [[GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, self::SERVICE***REMOVED******REMOVED***,
            'actions' => [***REMOVED***
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['dependency-many'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            'dependency' => [
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, self::REPOSITORY***REMOVED***,
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, self::SERVICE***REMOVED***,
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, self::FILTER***REMOVED***,
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, self::FORM***REMOVED***,
            ***REMOVED***,
            'actions' => [***REMOVED***
        ***REMOVED***;

        $dependencies[***REMOVED*** = [
            'name' => GearFile::KEYS['dependency-full'***REMOVED***[$this->keyStyle***REMOVED***,
            'extends' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'namespace' => '%s',
            'implements' => $this->gearFile->createMultiplesImplements(
                $this->suite,
                $this->type,
                1,
                $this->repeat,
                $this->keyStyle
            ),
            'type' => $this->type,
            'dependency' => [[GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, self::SERVICE***REMOVED******REMOVED***,
            'actions' => [***REMOVED***
        ***REMOVED***;

        $dependencies[***REMOVED*** = [
            'name' => GearFile::KEYS['dependency-many-full'***REMOVED***[$this->keyStyle***REMOVED***,
            'extends' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'namespace' => '%s',
            'implements' => $this->gearFile->createMultiplesImplements(
                $this->suite,
                $this->type,
                $this->repeat,
                $this->repeat,
                $this->keyStyle
            ),
            'type' => $this->type,
            'dependency' => [
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, self::REPOSITORY***REMOVED***,
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, self::SERVICE***REMOVED***,
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, self::FILTER***REMOVED***,
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, self::FORM***REMOVED***,
            ***REMOVED***,
            'actions' => [***REMOVED***
        ***REMOVED***;

        return [$invokables, ['invokables', 'factories'***REMOVED***, $this->type, $this->repeat***REMOVED***;
    }

    private function createPrepareDependency()
    {

        $invokables = [***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => self::REPOSITORY
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => self::SERVICE
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => self::FORM
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => self::FILTER
        ***REMOVED***;

        return [$invokables, ['invokables', 'factories'***REMOVED***, $this->type, $this->repeat***REMOVED***;
    }

    private function createPrepareInterface()
    {
        $type = $this->suite->isUsingLongName() ? $this->type : substr($this->type, 0, 5);

        $implements = [***REMOVED***;
        $implements[***REMOVED*** = [
            'name' => $type.GearFile::KEYS_BASE['implements'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => self::INTERFACE
        ***REMOVED***;


        $interfaces = [$implements, ['0' => ''***REMOVED***, $this->type, $this->repeat***REMOVED***;

        return $interfaces;
    }
}
