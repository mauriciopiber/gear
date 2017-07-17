<?php
namespace Gear\Integration\Suite\Src\SrcGenerator;

use Gear\Integration\Component\GearFile\GearFileTrait;
use Gear\Integration\Component\TestFile\TestFileTrait;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Component\TestFile\TestFile;
use GearJson\Src\SrcTypesInterface;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/Src/SrcGenerator
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcGenerator
{
    use GearFileTrait;

    use TestFileTrait;

    protected $minorSuite;

    /**
     * Constructor
     *
     * @param GearFile $gearFile Gear File
     * @param TestFile $testFile Test File
     *
     * @return \Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator
     */
    public function __construct(
        GearFile $gearFile,
        TestFile $testFile
    ) {
        $this->gearFile = $gearFile;
        $this->testFile = $testFile;

        return $this;
    }

    private function generateBaseInterface()
    {
        $type = $this->suite->isUsingLongName() ? $this->type : substr($this->type, 0, 5);

        $implements = [***REMOVED***;
        $implements[***REMOVED*** = [
            'name' => $type.GearFile::KEYS_BASE['implements'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => SrcTypesInterface::INTERFACE
        ***REMOVED***;


        return [$implements, ['0' => ''***REMOVED***, $this->type, $this->repeat***REMOVED***;
    }

    private function generateBaseClass()
    {
        $invokables = [***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type
        ***REMOVED***;

        return [$invokables, $this->getConfig(), $this->type, $this->repeat***REMOVED***;
    }

    public function getConfig()
    {
        $config = ['invokables'***REMOVED***;

        if (!in_array($this->type, [SrcTypesInterface::VALUE_OBJECT***REMOVED***)) {
            $config[***REMOVED*** = 'factories';
        }

        if (in_array($this->type, [SrcTypesInterface::SERVICE, SrcTypesInterface::REPOSITORY, SrcTypesInterface::VALUE_OBJECT***REMOVED***)) {
            $config[***REMOVED*** = 'abstract';
        }

        return $config;
    }

    public function createImplements()
    {
        $invokables = [***REMOVED***;
        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['implements'***REMOVED***[$this->keyStyle***REMOVED***,
            'implements' => $this->gearFile->createMultiplesImplements(
                $this->suite,
                $this->type,
                1,
                $this->repeat,
                $this->keyStyle
            ),
            'type' => $this->type
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
            'type' => $this->type
        ***REMOVED***;

        return $invokables;
    }

    public function createDependencies()
    {
        $dependencies = [***REMOVED***;

        $dependencies[***REMOVED*** = [
            'name' => GearFile::KEYS['dependency'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            'dependency' => [[GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED******REMOVED***
        ***REMOVED***;

        $dependencies[***REMOVED*** = [
            'name' => GearFile::KEYS['dependency-many'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            'dependency' => [
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED***,
                [GearFile::KEYS['extends'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED***,
                [GearFile::KEYS['implements'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED***,
                    //GearFile::KEYS['namespace'***REMOVED***[$this->keyStyle***REMOVED***,
            ***REMOVED***
        ***REMOVED***;

        $depFull = [
            'name' => GearFile::KEYS['dependency-full'***REMOVED***[$this->keyStyle***REMOVED***,
            'extends' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'namespace' => '%s',
            'type' => $this->type,
            'dependency' => [[GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED******REMOVED***
        ***REMOVED***;

        if (in_array($this->type, [SrcTypesInterface::SERVICE, SrcTypesInterface::REPOSITORY***REMOVED***)) {
            $depFull['implements'***REMOVED*** = $this->gearFile->createMultiplesImplements(
                $this->suite,
                $this->type,
                1,
                $this->repeat,
                $this->keyStyle
            );
        }

        $dependencies[***REMOVED*** = $depFull;

        $depsFull = [
            'name' => GearFile::KEYS['dependency-many-full'***REMOVED***[$this->keyStyle***REMOVED***,
            'extends' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'namespace' => '%s',
            'type' => $this->type,
            'dependency' => [
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED***,
                [GearFile::KEYS['extends'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED***,
                [GearFile::KEYS['implements'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED***
                //GearFile::KEYS['namespace'***REMOVED***[$this->keyStyle***REMOVED***,
            ***REMOVED***
        ***REMOVED***;

        if (in_array($this->type, [SrcTypesInterface::SERVICE, SrcTypesInterface::REPOSITORY***REMOVED***)) {
            $depsFull['implements'***REMOVED*** = $this->gearFile->createMultiplesImplements(
                $this->suite,
                $this->type,
                $this->repeat,
                $this->repeat,
                $this->keyStyle
            );
        }

        $dependencies[***REMOVED*** = $depsFull;

        $config = ['factories'***REMOVED***;

        if ($this->type != SrcTypesInterface::CONTROLLER_PLUGIN) {
            $config[***REMOVED*** = 'abstract';
        }

        return [$dependencies, $config, $this->type, $this->repeat***REMOVED***;
    }

    public function generateInterfaces()
    {
        //extends
        //dependency
        //namespace
        //all

        $src = [***REMOVED***;


        //simple
        $src[***REMOVED*** = [
            'name' => GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type
        ***REMOVED***;

        //namespace
        $src[***REMOVED*** = [
            'name' => GearFile::KEYS['namespace'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            'namespace' => '%s'
        ***REMOVED***;

        //extends
        $src[***REMOVED*** = [
            'name' => GearFile::KEYS['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'extends' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type
        ***REMOVED***;

        //single dependency
        $src[***REMOVED*** = [
            'name' => GearFile::KEYS['dependency'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            //'dependency' => [[GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED******REMOVED***
        ***REMOVED***;

        //all dependency
        $src[***REMOVED*** = [
            'name' => GearFile::KEYS['dependency-many'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            /*
            'dependency' => [
                [GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED***,
                [GearFile::KEYS['extends'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED***,
                [GearFile::KEYS['implements'***REMOVED***[$this->keyStyle***REMOVED***, $this->type***REMOVED***,
                //GearFile::KEYS['namespace'***REMOVED***[$this->keyStyle***REMOVED***,
            ***REMOVED***
            */
        ***REMOVED***;

        //full options

        //
        $srcOptions[***REMOVED*** = [$src, ['0' => ''***REMOVED***, $this->type, $this->repeat***REMOVED***;

        return $this->generate($srcOptions);
    }


    public function generateMinorSuite($srcMinor)
    {
        $this->suite = $srcMinor;

        $this->type = $this->suite->getType();
        $this->repeat = $this->suite->getRepeat();


        $this->keyStyle = ($this->suite->isUsingLongName()) ? 'long' : 'short';


        if (in_array($this->type, [SrcTypesInterface::INTERFACE***REMOVED***)) {
            return $this->generateInterfaces();
        }



        $srcOptions = [***REMOVED***;

        if (in_array($this->type, [SrcTypesInterface::SERVICE, SrcTypesInterface::REPOSITORY***REMOVED***)) {
            $srcOptions[***REMOVED*** = $this->generateBaseInterface();
        }

        $srcOptions[***REMOVED*** = $this->generateBaseClass();

        $invokables = [***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['namespace'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type,
            'namespace' => '%s'
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'extends' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type
        ***REMOVED***;

        //implements

        if (in_array($this->type, [SrcTypesInterface::SERVICE, SrcTypesInterface::REPOSITORY***REMOVED***)) {
            $invokables = array_merge($invokables, $this->createImplements());
        }

        $full = [
            'name' => GearFile::KEYS['full'***REMOVED***[$this->keyStyle***REMOVED***,
            'extends' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'namespace' => '%s',
            'type' => $this->type
        ***REMOVED***;

        if (in_array($this->type, [SrcTypesInterface::SERVICE, SrcTypesInterface::REPOSITORY***REMOVED***)) {
            $full['implements'***REMOVED*** = $this->gearFile->createMultiplesImplements(
                $this->suite,
                $this->type,
                $this->repeat,
                $this->repeat,
                $this->keyStyle
            );
        }

        $invokables[***REMOVED*** = $full;

        $srcOptions[***REMOVED*** = [$invokables, $this->getConfig(), $this->type, $this->repeat***REMOVED***;

        //to max dependency based on repeat number. interfaces too.
        if (in_array($this->type, [SrcTypesInterface::SERVICE, SrcTypesInterface::REPOSITORY, SrcTypesInterface::CONTROLLER_PLUGIN***REMOVED***)) {
            $srcOptions[***REMOVED*** = $this->createDependencies();
        }

        return $this->generate($srcOptions);
    }

    public function generate($srcOptions)
    {
        $gearfile =  $this->gearFile->createSrcGearfile($this->suite, ['src' => $srcOptions***REMOVED***);

        $this->suite->setGearFile($gearfile);

        $this->testFile->updateTestFile($this->suite);

        echo sprintf('        - minor: %s', $this->suite->getType())."\n";

        return $this->suite;
    }
}
