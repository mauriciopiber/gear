<?php
namespace GearTest\CreatorTest;

use PHPUnit_Framework_TestCase as TestCase;
use GearJson\Src\Src;
use Gear\Creator\Code;
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
        
        $this->code->setStringService(new StringService());
        
        $this->template = (new \Gear\Module())->getLocation().'/../../';
        $this->template .= 'test/template/module/code';
    }
    
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
                    'Service\ExternalLongNameServiceWillBeCut',
                    'Service\TestingService'
                ***REMOVED***
            ***REMOVED***
        );
        
        
        $constructor = $this->code->getConstructor($src);
        
        $expect = <<<EOS
    /**
     * Constructor
     *
     * @param RepositoryOne                    \$repositoryOne        Repository One
     * @param ExternalService                  \$externalService      External Service
     * @param ExternalLongNameServiceWillBeCut \$externalLongNameWill External Long Name Service Will Be Cut
     * @param TestingService                   \$testingService       Testing Service
     *
     * @return \MyModule\Service\Test
     */
    public function __construct(
        RepositoryOne \$repositoryOne,
        ExternalService \$externalService,
        ExternalLongNameServiceWillBeCut \$externalLongNameWill,
        TestingService \$testingService
    ) {
        \$this->repositoryOne = \$repositoryOne;
        \$this->externalService = \$externalService;
        \$this->externalLongNameServiceWillBeCut = \$externalLongNameWill;
        \$this->testingService = \$testingService;

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
    public function testGetUse()
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

        $this->srcDependency = new \Gear\Creator\SrcDependency();
        $this->srcDependency->setModule($this->module->reveal());
        $this->code->setSrcDependency($this->srcDependency);

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
