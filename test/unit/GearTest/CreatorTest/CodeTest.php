<?php
namespace GearTest\CreatorTest;

use PHPUnit_Framework_TestCase as TestCase;
use GearJson\Src\Src;
use GearJson\Controller\Controller;
use Gear\Creator\Code;
use Gear\Creator\SrcDependency;
use Gear\Creator\ControllerDependency;
use GearBase\Util\String\StringService;

/**
 * @group RefactoringSrc
 * @group Code
 */
class CodeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->code = new Code();

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');


        $this->code->setModule($this->module->reveal());


        $this->string = new StringService();
        $this->code->setStringService($this->string);


        $this->srcDependency = new SrcDependency();
        $this->srcDependency->setStringService($this->string);
        $this->srcDependency->setModule($this->module->reveal());

        $this->controllerDependency = new ControllerDependency();
        $this->controllerDependency->setStringService($this->string);
        $this->controllerDependency->setModule($this->module->reveal());

        $this->code->setSrcDependency($this->srcDependency);
        $this->code->setControllerDependency($this->controllerDependency);

        $this->template = (new \Gear\Module())->getLocation().'/../../';
        $this->template .= 'test/template/module/code';
    }

    /**
     * @dataProvider testCodeData
     */
    public function testGetUse($data, $template)
    {
        $use = $this->code->getUse($data);
        $this->assertEquals(file_get_contents(__DIR__.'/_asserts/use/'.$template.'.phtml'), $use);
    }


    public function testCodeData()
    {
        return [
            [new Controller(['name' => 'MyController'***REMOVED***), 'my-controller'***REMOVED***,
            [new Src(['name' => 'MyService', 'type' => 'Service'***REMOVED***), 'my-service'***REMOVED***,
            [
                new Src(['name' => 'MyService', 'type' => 'Service'***REMOVED***),
                'my-service'
            ***REMOVED***,
            [
                new Src(['name' => 'MyService', 'type' => 'Service', 'dependency' => 'Service\MyDependencyService'***REMOVED***),
                'my-service-dependency'
            ***REMOVED***,
            [
                new Src(['name' => 'MyService', 'type' => 'Service', 'dependency' => 'Service\MyDependencyService', 'service' => 'factories'***REMOVED***),
                'my-service-factory-dependency'
            ***REMOVED***,
            [
                new Src(
                    [
                        'name' => 'MyService',
                        'type' => 'Service',
                        'dependency' => 'Service\MyDependencyService,Service\MyDependencyServiceTwo,Service\MyDependencyServiceThree',
                        'service' => 'factories',
                        'extends' => 'Extends\MyExtendsService',
                        'implements' => 'Implementable\ImplementsOne,Implementable\ImplementsTwo'
                    ***REMOVED***
                ),
                'my-service-complete'
            ***REMOVED***
        ***REMOVED***;
    }

    public function testConstructorEmpty()
    {
        $src = new Src(
            [
                'name' => 'Test',
                'type' => 'Service',
                'service' => 'factories'
            ***REMOVED***
        );


        $constructor = $this->code->getConstructor($src);

        $expect = <<<EOS
    /**
     * Constructor
     *
     * @return \MyModule\Service\Test
     */
    public function __construct()
    {
        return \$this;
    }

EOS;

        $this->assertEquals($expect, $constructor);

    }

    /**
     * @group fx2
     */
    public function testConstructorWithDependencies()
    {
        $src = new Src(
            [
                'name' => 'Test',
                'type' => 'Service',
                'service' => 'factories',
                'dependency' => [
                    'Repository\RepositoryOne',
                    'Service\ExternalService',
                    'Service\ExternalLong',
                    'Service\TestingService'
                ***REMOVED***
            ***REMOVED***
        );


        $constructor = $this->code->getConstructor($src);

        $expect = <<<EOS
    /**
     * Constructor
     *
     * @param RepositoryOne   \$repositoryOne   Repository One
     * @param ExternalService \$externalService External Service
     * @param ExternalLong    \$externalLong    External Long
     * @param TestingService  \$testingService  Testing Service
     *
     * @return \MyModule\Service\Test
     */
    public function __construct(
        RepositoryOne \$repositoryOne,
        ExternalService \$externalService,
        ExternalLong \$externalLong,
        TestingService \$testingService
    ) {
        \$this->repositoryOne = \$repositoryOne;
        \$this->externalService = \$externalService;
        \$this->externalLong = \$externalLong;
        \$this->testingService = \$testingService;

        return \$this;
    }

EOS;

        $this->assertEquals($expect, $constructor);

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

        $token = $this->code->tokenizeParams($data);

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

        $token = $this->code->tokenizeParams($data);


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

        $this->code->cutVars($data);

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

        $this->code->cutVars($data);

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

        $this->code->cutVars($data);

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

        $this->assertEquals($expected, array_values($this->code->iterateRemoveNames($names, $issues, $move)));
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

        $data = $this->code->iterateRemoveNames($names, $issues, $move);
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

        $this->code->cutVars($data);

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

        $token = $this->code->tokenizeParams($data);

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
        $data[***REMOVED*** = explode(' ', 'Service Invokables Extends One');
        $data[***REMOVED*** = explode(' ', 'Service Invokables Implements One');


        $token = $this->code->tokenizeParams($data);

        $this->assertArrayHasDupes($token);
        $this->assertEquals(
            [***REMOVED***,
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

        $token = $this->code->tokenizeParams($data);

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

        $token = $this->code->tokenizeParams($data);


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

        $token = $this->code->tokenizeParams($data);


        $this->assertEquals(
            ['oneRepository', 'twoRepositoryLong', 'threeRepositoryLong', 'fourRepositoryLong'***REMOVED***,
            $token
        );
    }


    /**
     * @group fx2
     */
    public function testConstructorWithDependenciesLongName()
    {
        $src = new Src(
            [
                'name' => 'Test',
                'type' => 'Service',
                'service' => 'factories',
                'dependency' => [
                    'Repository\RepositoryDependencyLongOne',
                    'Repository\RepositoryDependencyLongTwo',
                    'Repository\RepositoryDependencyLongThree',
                    'Repository\RepositoryDependencyLongFour',
                ***REMOVED***
            ***REMOVED***
        );


        $constructor = $this->code->getConstructor($src);

        $expect = <<<EOS
    /**
     * Constructor
     *
     * @param RepositoryDependencyLongOne   \$dependencyLongOne   Repository Dependency Long One
     * @param RepositoryDependencyLongTwo   \$dependencyLongTwo   Repository Dependency Long Two
     * @param RepositoryDependencyLongThree \$dependencyLongThree Repository Dependency Long Three
     * @param RepositoryDependencyLongFour  \$dependencyLongFour  Repository Dependency Long Four
     *
     * @return \MyModule\Service\Test
     */
    public function __construct(
        RepositoryDependencyLongOne \$dependencyLongOne,
        RepositoryDependencyLongTwo \$dependencyLongTwo,
        RepositoryDependencyLongThree \$dependencyLongThree,
        RepositoryDependencyLongFour \$dependencyLongFour
    ) {
        \$this->repositoryDependencyLongOne = \$dependencyLongOne;
        \$this->repositoryDependencyLongTwo = \$dependencyLongTwo;
        \$this->repositoryDependencyLongThree = \$dependencyLongThree;
        \$this->repositoryDependencyLongFour = \$dependencyLongFour;

        return \$this;
    }

EOS;

        $this->assertEquals($expect, $constructor);

    }

    public function getDataImplements()
    {
        return [
            [
                new Src(['name' => 'Test', 'type' => 'Service'***REMOVED***),
                [***REMOVED***,
                PHP_EOL
            ***REMOVED***,
            [
                new Src(['name' => 'Test', 'type' => 'Service', 'implements' => 'Repository\ImplementsInterface'***REMOVED***),
                [***REMOVED***,
                ' implements ImplementsInterface'."\n",
            ***REMOVED***,
            [
                new Src(
                    [
                        'name' => 'Test',
                        'type' => 'Service',
                        'implements' => ['Repository\ImplementsInterface', 'Repository\SecondInterface'***REMOVED***
                    ***REMOVED***
                ),
                [***REMOVED***,
                ' implements'."\n".'    ImplementsInterface,'."\n".'    SecondInterface'."\n",
            ***REMOVED***,
            [
                new Src(
                    [
                        'name' => 'Test',
                        'type' => 'Service',
                        'implements' => ['Repository\ImplementsInterface', 'Repository\SecondInterface'***REMOVED***
                    ***REMOVED***
                ),
                ['ModuleOne\MyThirdInterface', 'ModuleTwo\MyFourInterface'***REMOVED***,
                ' implements'."\n".'    MyThirdInterface,'."\n".'    MyFourInterface,'."\n".'    ImplementsInterface,'."\n".'    SecondInterface'."\n",
            ***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @group Creator
     */
    public function testGetUseConstructor()
    {
        $src = new Src(
            [
                'name' => 'MyRepository',
                'type' => 'Repository',
                'service' => 'factories',
                'dependency' => [
                    'doctrine.entitymanager.orm_default' => '\Doctrine\ORM\EntityManager',
                    '\GearBase\Repository\QueryBuilder'
                ***REMOVED***
            ***REMOVED***
        );

        $template = <<<EOS
use Doctrine\ORM\EntityManager;
use GearBase\Repository\QueryBuilder;

EOS;

        /*
        $this->srcDependency = new \Gear\Creator\SrcDependency();
        $this->srcDependency->setModule($this->module->reveal());
        $this->code->setSrcDependency($this->srcDependency);
        */

        $this->assertEquals($template, $this->code->getUseConstructor($src));
    }

    /**
     * @dataProvider getDataImplements
     */
    public function testImplements($src, $additional, $template = null)
    {
        $this->assertEquals($template, $this->code->getImplements($src, $additional));
    }


    public function testGetFileDocs()
    {
        $src = new Src([
            'name' => 'MyFileDocs',
            'type' => 'Repository',
            'namespace' => 'MyDocs'
        ***REMOVED***);

        $this->assertEquals(file_get_contents($this->template.'/file-docs/simple.phtml'), $this->code->getFileDocs($src));
    }

    public function testGetClassDocs()
    {
        $src = new Src([
            'name' => 'MyFileDocs',
            'type' => 'Repository',
            'namespace' => 'MyDocs'
        ***REMOVED***);

        $this->assertEquals(file_get_contents($this->template.'/class-docs/simple.phtml'), $this->code->getClassDocs($src));
    }
}
