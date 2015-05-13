<?php
namespace GearTest\RepositoryTest\TestTest;

use GearBaseTest\AbstractTestCase;

class RepositoryTestServiceTest extends AbstractTestCase
{
    use \Gear\Common\RepositoryTestServiceTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getTestRepositoryFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getTestRepositoryFolder')->willReturn(__DIR__.'/_files');
        $this->getRepositoryTestService()->setModule($module);

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');
        $init = $schema->init();
        $schema->persistSchema($init);
        $this->getRepositoryTestService()->setGearSchema($schema);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../view');
        $this->getRepositoryTestService()->getTemplateService()->setRenderer($phpRenderer);

    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    /**
     * @group test-repository-001
     */
    public function testCreate()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepository');
        $src->expects($this->any())->method('getType')->willReturn('Repository');

        $this->getRepositoryTestService()->createFromSrc($src);


        $expected = file_get_contents(__DIR__.'/_expected/repository/test-001.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-repository-002
     */
    public function testCreateSrcDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryDependency');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getRepositoryTestService()->createFromSrc($src);


        $expected = file_get_contents(__DIR__.'/_expected/repository/test-002.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryDependencyTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-repository-003
     */
    public function testCreateSrcMultiDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryMultiDependency');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Service\OtherService', 'Service\AnotherService', 'Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getRepositoryTestService()->createFromSrc($src);


        $expected = file_get_contents(__DIR__.'/_expected/repository/test-003.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryMultiDependencyTest.php');

        $this->assertEquals($expected, $actual);

    }

    /**
     * @group test-repository-004
     */
    public function testCreateSrcExtends()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryExtends');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getExtends')->willReturn('GearBase\Repository\AbstractRepository');
        $this->getRepositoryTestService()->createFromSrc($src);


        $expected = file_get_contents(__DIR__.'/_expected/repository/test-004.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryExtendsTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-repository-005
     */
    public function testCreateSrcDependencyExtends()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryExtendsDependency');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getExtends')->willReturn('GearBase\Repository\AbstractRepository');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getRepositoryTestService()->createFromSrc($src);

        $expected = file_get_contents(__DIR__.'/_expected/repository/test-005.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryExtendsDependencyTest.php');

        $this->assertEquals($expected, $actual);
    }
}
