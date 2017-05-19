<?php
namespace Gear\Integration\Suite\Src\SrcGenerator;

use Gear\Integration\Component\GearFile\GearFileTrait;
use Gear\Integration\Component\TestFile\TestFileTrait;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Component\TestFile\TestFile;

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

    const VALUE_OBJECT = 'value-object';

    const REPOSITORY = 'repository';

    const SERVICE = 'service';

    const INTERFACE = 'interface';

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
        $implements = [***REMOVED***;
        $implements[***REMOVED*** = [
            'name' => $this->type.GearFile::KEYS_BASE['implements'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => self::INTERFACE
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

        if (!in_array($this->type, [self::VALUE_OBJECT***REMOVED***)) {
            $config[***REMOVED*** = 'factories';
        }

        if (in_array($this->type, [self::SERVICE, self::REPOSITORY, self::VALUE_OBJECT***REMOVED***)) {
            $config[***REMOVED*** = 'abstract';
        }

        return $config;
    }

    public function generateMinorSuite($srcMinor)
    {
        $this->minorSuite = $srcMinor;

        $this->type = $srcMinor->getType();
        $this->repeat = $srcMinor->getRepeat();

        $type = $srcMinor->getType();
        $repeat = $srcMinor->getRepeat();
        $keyStyle = ($srcMinor->isUsingLongName()) ? 'long' : 'short';

        $this->keyStyle = ($srcMinor->isUsingLongName()) ? 'long' : 'short';



        $srcOptions = [***REMOVED***;

        if (in_array($type, [self::SERVICE, self::REPOSITORY***REMOVED***)) {
            $srcOptions[***REMOVED*** = $this->generateBaseInterface();
        }

        $srcOptions[***REMOVED*** = $this->generateBaseClass();

        $invokables = [***REMOVED***;
        /*

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
            'name' => GearFile::KEYS['namespace'***REMOVED***[$this->keyStyle***REMOVED***,
            'extends' => GearFile::KEYS_BASE['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'type' => $this->type
        ***REMOVED***;

        //implements

*/
        if (in_array($type, [self::SERVICE, self::REPOSITORY***REMOVED***)) {

            $invokables[***REMOVED*** = [
                'name' => GearFile::KEYS['implements'***REMOVED***[$this->keyStyle***REMOVED***,
                'implements' => $this->gearFile->createMultiplesInterfaces($this->type, 1, $this->repeat, $this->keyStyle),
                'type' => $this->type
            ***REMOVED***;

            $invokables[***REMOVED*** = [
                'name' => GearFile::KEYS['implements-many'***REMOVED***[$this->keyStyle***REMOVED***,
                'implements' => $this->gearFile->createMultiplesInterfaces($this->type, $this->repeat, $this->repeat, $this->keyStyle),
                'type' => $this->type
            ***REMOVED***;
        }



        /*
        $invokables[***REMOVED*** = [
            'name' => GearFile::KEYS['full'***REMOVED***[$this->keyStyle***REMOVED***,
            'extends' => GearFile::KEYS['extends'***REMOVED***[$this->keyStyle***REMOVED***,
            'namespace' => '%s',
            'implements' => $this->gearFile->createMultiplesInterfaces($this->type, $this->repeat, $this->keyStyle),
            'type' => $this->type
        ***REMOVED***;
        */

        //$data = array_merge($data, generateGearfiles($invokables, $config, $this->type, $repeat));
        $srcOptions[***REMOVED*** = [$invokables, $this->getConfig(), $this->type, $this->repeat***REMOVED***;

        /*
        $dependencies = [***REMOVED***;

        //to max dependency based on repeat number. interfaces too.
        if (in_array($this->type, [self::SERVICE, self::REPOSITORY***REMOVED***)) {


            /*
            $dependencies[***REMOVED*** = [
                'name' => GearFile::KEYS['dependency'***REMOVED***[$this->keyStyle***REMOVED***,
                'type' => $this->type,
                'dependency' => GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***
            ***REMOVED***;

            $dependencies[***REMOVED*** = [
                'name' => GearFile::KEYS['dependency-many'***REMOVED***[$this->keyStyle***REMOVED***,
                'type' => $this->type,
                'dependency' => [
                    GearFile::KEYS['default'***REMOVED***[$this->keyStyle***REMOVED***,
                    GearFile::KEYS['extends'***REMOVED***[$this->keyStyle***REMOVED***,
                    GearFile::KEYS['implements'***REMOVED***[$this->keyStyle***REMOVED***,
                ***REMOVED***
            ***REMOVED***;*/

            /*
            $dependencies[***REMOVED*** = [
                'name' => '%sDeps%s%s',
                'type' => $type,
                'dependency' => ['%s\%sInvok%s', '%s\%sExtendsInvok%s', '%s\%sImplementsInvok%s'***REMOVED***
            ***REMOVED***;

            $dependencies[***REMOVED*** = [
                'name' => '%sDepFull%s%s',
                'extends' => '%s\%sExtendable%s%s',
                'namespace' => '%s',
                'implements' => $this->gearFile->createMultiplesInterfaces($type, 1),
                'type' => $type,
                'dependency' => '%s\%sInvok%s'
            ***REMOVED***;

            $dependencies[***REMOVED*** = [
                'name' => '%sDepsFull%s%s',
                'extends' => '%s\%sExtendable%s%s',
                'namespace' => '%s',
                'implements' => $this->gearFile->createMultiplesInterfaces($type, $repeat),
                'type' => $type,
                'dependency' => ['%s\%sInvok%s', '%s\%sExtendsInvok%s', '%s$\%sImplementsInvok%s'***REMOVED***
            ***REMOVED***;

            $config = ['factories', 'abstract'***REMOVED***;

            $srcOptions[***REMOVED*** = [$dependencies, $config, $type, $repeat***REMOVED***;
            */
            //$data = array_merge($data, generateGearfiles($dependencies, $config, $type, $repeat));


        //}

        $gearfile =  $this->gearFile->createSrcGearfile($srcMinor, $srcOptions);

        $srcMinor->setGearFile($gearfile);

        $this->testFile->updateTestFile($srcMinor);

        echo sprintf('        - minor: %s', $srcMinor->getType())."\n";

        return $srcMinor;
    }

}
