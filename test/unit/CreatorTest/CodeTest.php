<?php
namespace GearTest\CreatorTest;

use PHPUnit\Framework\TestCase;
use Gear\Schema\Src\Src;
use Gear\Schema\Controller\Controller;
use Gear\Creator\Code;
use Gear\Creator\ControllerDependency;
use Gear\Util\String\StringService;
use Gear\Creator\Component\Constructor\ConstructorParams;

/**
 * @group RefactoringSrc
 * @group Code
 */
class CodeTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->code = new Code();

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');

        $this->code->setModule($this->module->reveal());

        $this->string = new StringService();
        $this->code->setStringService($this->string);

        $constructorParams = new ConstructorParams($this->string);

        $this->code->setConstructorParams($constructorParams);

        $this->template = (new \Gear\Module())->getLocation().'/../';
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
     * @return Test
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
     * @return Test
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
     * @return Test
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
