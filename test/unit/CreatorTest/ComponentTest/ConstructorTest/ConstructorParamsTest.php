<?php
namespace GearTest\CreatorTest\ComponentTest\ConstructorTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Util\String\StringService;

/**
 * @group Service
 */
class ConstructorParamsTest extends TestCase
{
    public function setUp() : void
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

    public function testForwardIntersect()
    {
        $data = [
            0 => 'Repository',
            2 => 'Invokables'
        ***REMOVED***;

        $this->assertEquals([0, 2***REMOVED***, $this->service->forwardIntersect($data));
    }

    public function testRevertIntersect()
    {
        $data = [
            0 => 'Repository',
            2 => 'Invokables'
        ***REMOVED***;

        $this->assertEquals([2, 0***REMOVED***, $this->service->revertIntersect($data));
    }



    /*
    public function testDetermineParams()
    {
        $already = [
            1 => 'RepositoryInvokables'
        ***REMOVED***;

        $data = [
            0 => 'RepositoryExtendsInvokables',
            2 => 'RepositoryImplementsInvokables',
        ***REMOVED***;

        $params = $this->service->determineParams($data);
    }*/


    public function params()
    {
        return [
            [
                [
                    'RepositoryInvokables',
                    'RepositoryExtendsInvokables',
                    'RepositoryImplementsInvokables',
                ***REMOVED***,
                ['repositoryInvokables', 'extendsInvokables', 'implementsInvokables'***REMOVED***
            ***REMOVED***,
            [
                [
                    'InvokablesRepository',
                    'ExtendsInvokablesRepository',
                    'ImplementsInvokablesRepository',
                ***REMOVED***,
                ['invokablesRepository', 'extendsRepository', 'implementsRepository'***REMOVED***
            ***REMOVED***,
            [
                [
                    'cache',
                    'entityThreeRepository',
                    'zfcuserAuthService',
                ***REMOVED***,
                ['cache', 'threeRepository', 'zfcuserAuthService'***REMOVED***
            ***REMOVED***
        ***REMOVED***;
    }

    /**
     * @group params
     * @dataProvider params
     */
    public function testCreateParams($data, $expected)
    {
        $params = $this->service->createParams($data);

        $this->assertEquals(
            $expected,
            $params
        );
    }

    /**
     * @group token
     */
    public function testTokenizeParamsEnd()
    {
        $data = [
            'RepositoryDependencyLongOne',
            'RepositoryDependencyLongTwo',
            'RepositoryDependencyLongThree',
            'RepositoryDependencyLongFour'
        ***REMOVED***;

        $token = $this->service->createParams($data);


        $this->assertEquals(
            ['dependencyLongOne', 'dependencyLongTwo', 'dependencyLongThree', 'dependencyLongFour'***REMOVED***,
            $token
        );
    }

    /**
     * @group token
     * @group tokenx3
     */
    public function testTokenizeControllerDbVeryLongDiffName()
    {
        $data = [
            'My Very Long Table Name Example Service',
            'My Very Long Table Name Example Form',
            'My Very Long Table Name Example Search Form',
            'Image Service'
        ***REMOVED***;

        $token = $this->service->createParams($data);

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
        $data = [
            'Service Invokables One',
            'Service Extends Invokables One',
            'Service Implements Invokables One'
        ***REMOVED***;

        $token = $this->service->createParams($data);

        $this->assertArrayHasDupes($token);
        $this->assertEquals(
            ['serviceInvokablesOne', 'extendsInvokablesOne', 'implementsOne'***REMOVED***,
            $token
        );
    }

    public function assertArrayHasDupes($array) {
        //streamline per @Felix
        $dupe = count($array) !== count(array_unique($array));
        $this->assertFalse($dupe);
    }


    /**
     * @group token
     * @group tokenx2
     */
    public function testTokenizeRepositoryDependency()
    {
        $data = [
            'Single Db Table Service',
            'Single Db Table Form',
            'Single Db Table Search Form'
        ***REMOVED***;

        $token = $this->service->createParams($data);

        $this->assertEquals(
            ['singleDbTableService', 'singleDbTableForm', 'dbTableSearchForm'***REMOVED***,
            $token
        );
    }

    /**
     * @group token
     * @group tokenx2
     */
    public function testTokenizeControllerDb()
    {
        $data = [
            'Single Db Table Service',
            'Single Db Table Form',
            'Single Db Table Search Form'
        ***REMOVED***;

        $token = $this->service->createParams($data);

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
            'OneRepository',
            'TwoRepository',
            'ThreeRepository',
            'FourRepository'
        ***REMOVED***;

        $token = $this->service->createParams($data);


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
            'OneRepositoryDependencyLong',
            'TwoRepositoryDependencyLong',
            'ThreeRepositoryDependencyLong',
            'FourRepositoryDependencyLong'
        ***REMOVED***;

        $token = $this->service->createParams($data);


        $this->assertEquals(
            ['oneDependencyLong', 'twoDependencyLong', 'threeDependencyLong', 'fourDependencyLong'***REMOVED***,
            $token
        );
    }
}
