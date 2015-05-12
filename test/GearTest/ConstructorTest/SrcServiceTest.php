<?php
namespace GearTest\ServiceTest\ConstructorTest;

use GearBaseTest\AbstractTestCase;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplateMapResolver;
use Zend\View\Resolver\TemplatePathStack;

class SrcServiceTest extends AbstractTestCase
{
    use \Gear\Service\Constructor\SrcServiceTrait;

    public function setUp()
    {

        parent::setUp();
        unset($this->srcService);
        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    public function mockCreateSrcWithoutType($moduleName, $srcName, $namespace, $extends)
    {
        $mockRequest = $this->getMockSingleClass('Zend\Http\PhpEnvironment\Request', array('getParam'));

        //name
        $mockRequest->expects($this->at(0))->method('getParam')->with($this->equalTo('name'))->willReturn($srcName);
        $mockRequest->expects($this->at(6))->method('getParam')->with($this->equalTo('extends'))->willReturn($extends);
        $mockRequest->expects($this->at(7))->method('getParam')->with($this->equalTo('namespace'))->willReturn($namespace);
        $mockRequest->expects($this->at(8))->method('getParam')->with($this->equalTo('yes'))->willReturn(true);


        $this->getSrcService()->setRequest($mockRequest);

        $mockSchema = $this->getMockSingleClass('Gear\Schema', array('insertSrc'));
        $mockSchema->expects($this->once())->method('insertSrc')->willReturn(true);

        $this->getSrcService()->setGearSchema($mockSchema);

        $mockModule = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getSrcModuleFolder', 'getModuleName', 'getTestUnitModuleFolder'));
        $mockModule->expects($this->any())->method('getTestUnitModuleFolder')->willReturn(__DIR__.'/_files/test/unit/'.$moduleName.'Test');
        $mockModule->expects($this->any())->method('getSrcModuleFolder')->willReturn(__DIR__.'/_files/src/'.$moduleName);
        $mockModule->expects($this->any())->method('getModuleName')->willReturn($moduleName);

        $this->getSrcService()->setModule($mockModule);

        $str = new \Gear\View\Helper\Str();
        $str->setServiceLocator($this->getServiceLocator());
        $helpers = new HelperPluginManager();
        $helpers->setService('str', $str);
        $view = new PhpRenderer();
        $view->setHelperPluginManager($helpers);


        $resolver = new AggregateResolver();

        $map = new TemplatePathStack(array(
            'script_paths' => array(
                'template' => __DIR__ . '/../../../view',
            )
        ));

        $resolver->attach($map);

        $view->setResolver($resolver);

        $this->getSrcService()->getTraitFile()->getTemplateService()->setRenderer($view);
        $this->getSrcService()->getTestFile()->getTemplateService()->setRenderer($view);
        $this->getSrcService()->getClassFile()->getTemplateService()->setRenderer($view);
        $this->getSrcService()->getFactoryFile()->getTemplateService()->setRenderer($view);


        $mockConfig = $this->getMockSingleClass('Gear\Service\Mvc\ConfigService', array('mergeServiceManagerConfig'));
        $mockConfig->expects($this->any())->method('mergeServiceManagerConfig')->willReturn(true);

        $this->getSrcService()->setConfigService($mockConfig);


    }

    /**
     * @group 001
     * use case 001.
     */
    public function testCreateSrcWithoutType()
    {
        $moduleName = 'ModuleUnit';
        $srcName    = 'UnitSrcName';
        $namespace  = 'Free/MyClass';
        $extends    = 'GearBase\Service\AbstractService';

        $this->mockCreateSrcWithoutType($moduleName, $srcName, $namespace, $extends);

        $this->getSrcService()->create();
        $src = $this->getSrcService()->getSrc();

        $this->assertInstanceOf('Gear\ValueObject\Src', $src);
        $this->assertEquals($srcName, $src->getName());
        $this->assertEquals(null, $src->getType());
        $this->assertEquals($extends, $src->getExtends());
        $this->assertEquals(null, $src->getDb());

        $this->assertEquals($namespace, $src->getNamespace());
        $this->assertEquals($moduleName.'\Free\MyClass', $this->getSrcService()->getClassNamespace());
        $this->assertEquals(__DIR__.'/_files/src/'.$moduleName.'/'.$src->getNamespace(), $this->getSrcService()->getClassLocation());

        $this->assertEquals($moduleName.'Test\FreeTest\MyClassTest', $this->getSrcService()->getTestClassNamespace());
        $this->assertEquals(__DIR__.'/_files/test/unit/'.$moduleName.'Test/FreeTest/MyClassTest', $this->getSrcService()->getTestClassLocation());
        $this->assertEquals('UnitSrcNameTest.php', $this->getSrcService()->getTestClassName());

        $srcFactory = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'Factory.php');
        $expectFactory = file_get_contents(__DIR__.'/_expected/use-case-001-factory.phtml');
        $this->assertEquals($expectFactory, $srcFactory);

        $srcTrait = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'Trait.php');
        $expectTrait = file_get_contents(__DIR__.'/_expected/use-case-001-trait.phtml');
        $this->assertEquals($expectTrait, $srcTrait);


        $srcClass = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'.php');
        $expectClass = file_get_contents(__DIR__.'/_expected/use-case-001-src.phtml');
        $this->assertEquals($expectClass, $srcClass);


        $srcTest  = file_get_Contents($this->getSrcService()->getTestClassLocation().'/'.$this->getSrcService()->getTestClassName());
        $expectTest = file_get_contents(__DIR__.'/_expected/use-case-001-test.phtml');
        $this->assertEquals($expectTest, $srcTest);
        //$this->assertEquals();

        //get class
        //get trait
        //get test

        //$this->assertEquals('', $this->getSrcService()->getTestClassName());
    }

    /**
     * @group 002
     */
    public function testCreateSrcWithoutTypeTwo()
    {
        $moduleName = 'ModuleUnitTwo';
        $srcName    = 'UnitSrcNameTwo';
        $namespace  = 'Free/MyClassTwo';
        $extends    = 'GearBase\Service\AbstractService';

        $this->mockCreateSrcWithoutType($moduleName, $srcName, $namespace, $extends);

        $this->getSrcService()->create();
        $src = $this->getSrcService()->getSrc();

        $this->assertInstanceOf('Gear\ValueObject\Src', $src);
        $this->assertEquals($srcName, $src->getName());
        $this->assertEquals(null, $src->getType());
        $this->assertEquals($extends, $src->getExtends());
        $this->assertEquals(null, $src->getDb());

        $this->assertEquals($namespace, $src->getNamespace());
        $this->assertEquals($moduleName.'\Free\MyClassTwo', $this->getSrcService()->getClassNamespace());
        $this->assertEquals(__DIR__.'/_files/src/'.$moduleName.'/'.$src->getNamespace(), $this->getSrcService()->getClassLocation());

        $this->assertEquals($moduleName.'Test\FreeTest\MyClassTwoTest', $this->getSrcService()->getTestClassNamespace());
        $this->assertEquals(__DIR__.'/_files/test/unit/'.$moduleName.'Test/FreeTest/MyClassTwoTest', $this->getSrcService()->getTestClassLocation());
        $this->assertEquals('UnitSrcNameTwoTest.php', $this->getSrcService()->getTestClassName());


        $srcFactory = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'Factory.php');
        $expectFactory = file_get_contents(__DIR__.'/_expected/use-case-002-factory.phtml');
        $this->assertEquals($expectFactory, $srcFactory);


        $srcTrait = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'Trait.php');
        $expectTrait = file_get_contents(__DIR__.'/_expected/use-case-002-trait.phtml');
        $this->assertEquals($expectTrait, $srcTrait);


        $srcClass = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'.php');
        $expectClass = file_get_contents(__DIR__.'/_expected/use-case-002-src.phtml');
        $this->assertEquals($expectClass, $srcClass);


        $srcTest  = file_get_Contents($this->getSrcService()->getTestClassLocation().'/'.$this->getSrcService()->getTestClassName());
        $expectTest = file_get_contents(__DIR__.'/_expected/use-case-002-test.phtml');
        $this->assertEquals($expectTest, $srcTest);
    }

    /**
     * @group 003
     */
    public function testCreateFreeSrcWithoutExtends()
    {
        $moduleName = 'NoExtends';
        $srcName    = 'ClassWithoutExtends';
        $namespace  = 'TryWithoutExtends';
        $extends    = null;//'GearBase\Service\AbstractService';

        $this->mockCreateSrcWithoutType($moduleName, $srcName, $namespace, $extends);

        $this->getSrcService()->create();
        $src = $this->getSrcService()->getSrc();

        $this->assertInstanceOf('Gear\ValueObject\Src', $src);
        $this->assertEquals($srcName, $src->getName());
        $this->assertEquals(null, $src->getType());
        $this->assertEquals(null, $src->getExtends());
        $this->assertEquals(null, $src->getDb());


        $this->assertEquals($namespace, $src->getNamespace());
        $this->assertEquals($moduleName.'\\'.$namespace, $this->getSrcService()->getClassNamespace());
        $this->assertEquals(__DIR__.'/_files/src/'.$moduleName.'/'.$src->getNamespace(), $this->getSrcService()->getClassLocation());

        $this->assertEquals($moduleName.'Test\TryWithoutExtendsTest', $this->getSrcService()->getTestClassNamespace());
        $this->assertEquals(__DIR__.'/_files/test/unit/'.$moduleName.'Test/TryWithoutExtendsTest', $this->getSrcService()->getTestClassLocation());
        $this->assertEquals('ClassWithoutExtendsTest.php', $this->getSrcService()->getTestClassName());


        $srcFactory = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'Factory.php');
        $expectFactory = file_get_contents(__DIR__.'/_expected/use-case-003-factory.phtml');
        $this->assertEquals($expectFactory, $srcFactory);

        $srcTrait = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'Trait.php');
        $expectTrait = file_get_contents(__DIR__.'/_expected/use-case-003-trait.phtml');
        $this->assertEquals($expectTrait, $srcTrait);


        $srcClass = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'.php');
        $expectClass = file_get_contents(__DIR__.'/_expected/use-case-003-src.phtml');
        $this->assertEquals($expectClass, $srcClass);


        $srcTest  = file_get_Contents($this->getSrcService()->getTestClassLocation().'/'.$this->getSrcService()->getTestClassName());
        $expectTest = file_get_contents(__DIR__.'/_expected/use-case-003-test.phtml');
        $this->assertEquals($expectTest, $srcTest);
    }

    /**
     * @group 004
     */

    public function testCreateSrcWithoutNamespaceExtends()
    {
        unset($this->srcService);

        $moduleName = 'Catalog';
        $srcName    = 'Product';
        $namespace  = null;
        $extends    = null;

        $this->mockCreateSrcWithoutType($moduleName, $srcName, $namespace, $extends);

        $this->getSrcService()->create();
        $src = $this->getSrcService()->getSrc();

        $this->assertInstanceOf('Gear\ValueObject\Src', $src);
        $this->assertEquals($srcName, $src->getName());
        $this->assertEquals(null, $src->getType());
        $this->assertEquals(null, $src->getExtends());
        $this->assertEquals(null, $src->getDb());

        $this->assertEquals(null, $src->getNamespace());
        $this->assertEquals($moduleName, $this->getSrcService()->getClassNamespace());
        $this->assertEquals(__DIR__.'/_files/src/'.$moduleName.'/', $this->getSrcService()->getClassLocation());

        $this->assertEquals($moduleName.'Test', $this->getSrcService()->getTestClassNamespace());
        $this->assertEquals(__DIR__.'/_files/test/unit/'.$moduleName.'Test/', $this->getSrcService()->getTestClassLocation());
        $this->assertEquals('ProductTest.php', $this->getSrcService()->getTestClassName());


        $srcFactory = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'Factory.php');
        $expectFactory = file_get_contents(__DIR__.'/_expected/use-case-004-factory.phtml');
        $this->assertEquals($expectFactory, $srcFactory);

        $srcTrait = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'Trait.php');
        $expectTrait = file_get_contents(__DIR__.'/_expected/use-case-004-trait.phtml');
        $this->assertEquals($expectTrait, $srcTrait);


        $srcClass = file_get_contents($this->getSrcService()->getClassLocation().'/'.$this->getSrcService()->getClassName().'.php');
        $expectClass = file_get_contents(__DIR__.'/_expected/use-case-004-src.phtml');
        $this->assertEquals($expectClass, $srcClass);


        $srcTest  = file_get_Contents($this->getSrcService()->getTestClassLocation().'/'.$this->getSrcService()->getTestClassName());
        $expectTest = file_get_contents(__DIR__.'/_expected/use-case-004-test.phtml');
        $this->assertEquals($expectTest, $srcTest);

    }

/*
    public function testCreateSrcWithoutNamespaceExtends()
    {
        unset($this->srcService);

        $moduleName = 'Catalog';
        $srcName    = 'Product';
        $namespace  = null;
        $extends    = null;

        $this->mockCreateSrcWithoutType($moduleName, $srcName, $namespace, $extends);

        $this->getSrcService()->create();
        $src = $this->getSrcService()->getSrc();

        $this->assertInstanceOf('Gear\ValueObject\Src', $src);
        $this->assertEquals($srcName, $src->getName());
        $this->assertEquals(null, $src->getType());
        $this->assertEquals(null, $src->getExtends());
        $this->assertEquals(null, $src->getDb());

        $this->assertEquals(null, $src->getNamespace());
        $this->assertEquals($moduleName.'\\', $this->getSrcService()->getClassNamespace());
        $this->assertEquals(__DIR__.'/_files/src/'.$moduleName.'/', $this->getSrcService()->getClassLocation());

        $this->assertEquals($moduleName.'Test', $this->getSrcService()->getTestClassNamespace());
        $this->assertEquals(__DIR__.'/_files/test/unit/'.$moduleName.'Test/', $this->getSrcService()->getTestClassLocation());
        $this->assertEquals('CatalogTest.php', $this->getSrcService()->getTestClassName());

        foreach (glob(__DIR__.'/_files/*') as $file) {
            unlink($file);
        }

    } */


}
