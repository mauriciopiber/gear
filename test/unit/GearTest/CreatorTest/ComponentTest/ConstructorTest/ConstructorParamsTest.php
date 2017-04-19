<?php
namespace GearTest\CreatorTest\ComponentTest\ConstructorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Creator\Component\Constructor\ConstructorParams;
use GearBase\Util\String\StringService;

/**
 * @group Service
 */
class ConstructorParamsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->stringService = new StringService;

        $this->service = new ConstructorParams(
            $this->stringService
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Creator\Component\Constructor\ConstructorParams', $this->service);
    }


    /**
     * @group token
     * @group tokenx4
     */
    public function testTokenizeAMothafuckerDependency()
    {

        $data = [
            ['cache'***REMOVED***,
            ['entity', 'Three', 'Repository'***REMOVED***,
            ['zfcuser', 'Auth', 'Service'***REMOVED***,
        ***REMOVED***;

        $token = $this->service->tokenizeParams($data);

        $this->assertEquals(
            ['cache', 'threeRepository', 'zfcuserAuthService'***REMOVED***,
            $token
        );
    }

    /**
     * @group token
     */
    public function testTokenizeParamsEnd()
    {
        $data = [
            ['Repository', 'Dependency', 'Long', 'One'***REMOVED***,
            ['Repository', 'Dependency', 'Long', 'Two'***REMOVED***,
            ['Repository', 'Dependency', 'Long', 'Three'***REMOVED***,
            ['Repository', 'Dependency', 'Long', 'Four'***REMOVED***
        ***REMOVED***;

        $token = $this->service->tokenizeParams($data);


        $this->assertEquals(
            ['dependencyLongOne', 'dependencyLongTwo', 'dependencyLongThree', 'dependencyLongFour'***REMOVED***,
            $token
        );
    }



    /**
     * @group token
     * @group tokenx4
     * @group tokenx4.1
     */
    public function testCutAMothafuckerDependency()
    {

        $data = [
            ['cache'***REMOVED***,
            ['entity', 'Three', 'Repository'***REMOVED***,
            ['zfcuser', 'Auth', 'Service'***REMOVED***,
        ***REMOVED***;

        $this->service->cutVars($data);

        $this->assertEquals(
            [['cache'***REMOVED***,
            ['Three', 'Repository'***REMOVED***,
            ['zfcuser', 'Auth', 'Service'***REMOVED******REMOVED***,
            $data
        );
    }

    /**
     * @group x1
     * @group x1.1
     *
     */
    public function testCutVarStart()
    {
        $data = [
            ['One', 'Repository', 'Dependency', 'Long'***REMOVED***,
            ['Two', 'Repository', 'Dependency', 'Long'***REMOVED***,
            ['Three', 'Repository', 'Dependency', 'Long'***REMOVED***,
            ['Four', 'Repository', 'Dependency', 'Long'***REMOVED***
        ***REMOVED***;

        $this->service->cutVars($data);

        $expected = [
            ['One', 'Repository'***REMOVED***,
            ['Two', 'Repository', 'Long'***REMOVED***,
            ['Three', 'Repository', 'Long'***REMOVED***,
            ['Four', 'Repository', 'Long'***REMOVED***,
        ***REMOVED***;

        $this->assertEquals($expected, $data);
    }

    /**
     * @group x1
     * @group x1.2

    public function testCutVarMiddle()
    {
        $data = [
            ['Repository', 'One', 'Dependency'***REMOVED***,
            ['Repository', 'Two', 'Dependency'***REMOVED***,
            ['Repository', 'Three', 'Dependency'***REMOVED***,
            ['Repository', 'Four', 'Dependency'***REMOVED***
        ***REMOVED***;

        $this->service->cutVars($data);

        $expected = [
            ['Repository', 'One'***REMOVED***,
            ['Repository', 'Two'***REMOVED***,
            ['Repository', 'Three'***REMOVED***,
            ['Repository', 'Four'***REMOVED***
        ***REMOVED***;

        $this->assertEquals($expected, $data);
    }
     */

    /**
     * @group token
     * @group tokenx3
     * @group tokenx3.1
     * @group tokenx3.1.1
     */
    public function testIterateRemoveNamesBackward()
    {
        $issues = [
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ***REMOVED***;

        $names = [
            0 => 'My',
            1 => 'Very',
            2 => 'Long',
            3 => 'Table',
            4 => 'Name',
            5 => 'Example',
            6 => 'Search',
            7 => 'Form',
        ***REMOVED***;

        $move = false;

        $expected = [
            0 => 'Example',
            1 => 'Search',
            2 => 'Form'
        ***REMOVED***;

        $this->assertEquals($expected, array_values($this->service->iterateRemoveNames($names, $issues, $move)));
    }

    /**
     * @group token
     * @group tokenx3
     * @group tokenx3.1
     * @group tokenx3.1.2
     */
    public function testIterateRemoveNamesForward()
    {
        $issues = [
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ***REMOVED***;

        $names = [
            0 => 'My',
            1 => 'Very',
            2 => 'Long',
            3 => 'Table',
            4 => 'Name',
            5 => 'Example',
            6 => 'Search',
            7 => 'Form',
        ***REMOVED***;

        $move = true;


        $expected = [
            'My',
            'Very',
            'Long',
            'Search',
            'Form'
        ***REMOVED***;

        $data = $this->service->iterateRemoveNames($names, $issues, $move);
        $this->assertEquals($expected, array_values($data));

    }


    /**
     * @group x1
     * @group x1.3
     */
    public function testCutVarEnd()
    {
        $data = [
            ['Repository', 'Dependency', 'Long', 'One'***REMOVED***,
            ['Repository', 'Dependency', 'Long', 'Two'***REMOVED***,
            ['Repository', 'Dependency', 'Long', 'Three'***REMOVED***,
            ['Repository', 'Dependency', 'Long', 'Four'***REMOVED***
        ***REMOVED***;

        $this->service->cutVars($data);

        $expected = [
            ['Dependency', 'Long', 'One'***REMOVED***,
            ['Dependency', 'Long', 'Two'***REMOVED***,
            ['Dependency', 'Long', 'Three'***REMOVED***,
            ['Dependency', 'Long', 'Four'***REMOVED***
        ***REMOVED***;

        $this->assertEquals($expected, $data);
    }

    /**
     * @group token
     * @group tokenx3
     */
    public function testTokenizeControllerDbVeryLongDiffName()
    {
        $data = [***REMOVED***;
        $data[***REMOVED*** = explode(' ', 'My Very Long Table Name Example Service');
        $data[***REMOVED*** = explode(' ', 'My Very Long Table Name Example Form');
        $data[***REMOVED*** = explode(' ', 'My Very Long Table Name Example Search Form');
        $data[***REMOVED*** = explode(' ', 'Image Service');

        $token = $this->service->tokenizeParams($data);

        $this->assertEquals(
            ['nameExampleService', 'tableNameExampleForm', 'exampleSearchForm', 'imageService'***REMOVED***,
            $token
        );
    }

    /**
     * @group token
     * @group tokenx2
     * @group tokenx5
     */
    public function testTokenizeSrcIssue01()
    {
        $data = [***REMOVED***;
        $data[***REMOVED*** = explode(' ', 'Service Invokables One');
        $data[***REMOVED*** = explode(' ', 'Service Extends Invokables One');
        $data[***REMOVED*** = explode(' ', 'Service Implements Invokables One');


        $token = $this->service->tokenizeParams($data);

        $this->assertArrayHasDupes($token);
        $this->assertEquals(
            ['serviceInvokablesOne', 'extendsInvokablesOne', 'serviceImplementsOne'***REMOVED***,
            $token
        );
    }

    function assertArrayHasDupes($array) {
        //streamline per @Felix
        $dupe = count($array) !== count(array_unique($array));
        $this->assertFalse($dupe);
    }

    /**
     * @group token
     * @group tokenx2
     */
    public function testTokenizeControllerDb()
    {
        $data = [***REMOVED***;
        $data[***REMOVED*** = explode(' ', 'Single Db Table Service');
        $data[***REMOVED*** = explode(' ', 'Single Db Table Form');
        $data[***REMOVED*** = explode(' ', 'Single Db Table Search Form');

        $token = $this->service->tokenizeParams($data);

        $this->assertEquals(
            ['singleDbTableService', 'singleDbTableForm', 'dbTableSearchForm'***REMOVED***,
            $token
        );
    }

    /**
     * @group token
     */
    public function testNormalTokenizerStart()
    {
        $data = [
            ['One', 'Repository'***REMOVED***,
            ['Two', 'Repository'***REMOVED***,
            ['Three', 'Repository'***REMOVED***,
            ['Four', 'Repository'***REMOVED***
        ***REMOVED***;

        $token = $this->service->tokenizeParams($data);


        $this->assertEquals(
            ['oneRepository', 'twoRepository', 'threeRepository', 'fourRepository'***REMOVED***,
            $token
        );
    }

    /**
     * @group token
     * @group x2
     */
    public function testTokenizeParamsStart()
    {
        $data = [
            ['One', 'Repository', 'Dependency', 'Long'***REMOVED***,
            ['Two', 'Repository', 'Dependency', 'Long'***REMOVED***,
            ['Three', 'Repository', 'Dependency', 'Long'***REMOVED***,
            ['Four', 'Repository', 'Dependency', 'Long'***REMOVED***
        ***REMOVED***;

        $token = $this->service->tokenizeParams($data);


        $this->assertEquals(
            ['oneRepository', 'twoRepositoryLong', 'threeRepositoryLong', 'fourRepositoryLong'***REMOVED***,
            $token
        );
    }
}
