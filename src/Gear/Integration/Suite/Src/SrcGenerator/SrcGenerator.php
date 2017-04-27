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

    public function generateMinorSuite($srcMinor)
    {
        $type = $srcMinor->getType();
        $repeat = $srcMinor->getRepeat();


        $srcOptions = [***REMOVED***;

        $data = [***REMOVED***;

        if (in_array($type, ['Service', 'Repository'***REMOVED***)) {

            $implements = [***REMOVED***;
            $implements[***REMOVED*** = [
                'name' => '%sImpl%s%s',
                'type' => 'Interface'
            ***REMOVED***;

            $srcOptions[***REMOVED*** = [$implements, ['0' => ''***REMOVED***, $type, $repeat***REMOVED***;

            //$data = array_merge($data, generateGearfiles($implements, ['0' => ''***REMOVED***, $type, $repeat));

        }
        $invokables = [***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => '%sExtendable%s%s',
            'type' => $type
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => '%s%s%s',
            'type' => $type
        ***REMOVED***;

        $invokables[***REMOVED*** = [
            'name' => '%sNamespace%s%s',
            'type' => $type,
            'namespace' => '%s'
        ***REMOVED***;

        //implements
        if (in_array($type, ['Service', 'Repository'***REMOVED***)) {

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
        }



        $invokables[***REMOVED*** = [
            'name' => '%sExtends%s%s',
            'extends' => '%s\%sExtendable%s%s',
            'type' => $type
        ***REMOVED***;


        $invokables[***REMOVED*** = [
            'name' => '%sFull%s%s',
            'extends' => '%s\%sExtendable%s%s',
            'namespace' => '%s',
            'implements' => $this->gearFile->createMultiplesInterfaces($type, $repeat),
            'type' => $type
        ***REMOVED***;

        $config = ['invokables'***REMOVED***;

        if (!in_array($type, ['ValueObject'***REMOVED***)) {
            $config[***REMOVED*** = 'factories';
        }

        if (in_array($type, ['Service', 'Repository'***REMOVED***)) {
            $config[***REMOVED*** = 'abstract';
        }


        //$data = array_merge($data, generateGearfiles($invokables, $config, $type, $repeat));
        $srcOptions[***REMOVED*** = [$invokables, $config, $type, $repeat***REMOVED***;

        $dependencies = [***REMOVED***;

        //to max dependency based on repeat number. interfaces too.
        if (in_array($type, ['Service', 'Repository'***REMOVED***)) {

            $dependencies[***REMOVED*** = [
                'name' => '%sDep%s%s',
                'type' => $type,
                'dependency' => '%s\%sInvok%s'
            ***REMOVED***;

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
            //$data = array_merge($data, generateGearfiles($dependencies, $config, $type, $repeat));

        }

        $srcMinor->setLocationKey(sprintf('src-%s', strtolower($srcMinor->getType())));
        return $this->gearFile->createSrcGearfile($srcMinor, $srcOptions);
    }

}
