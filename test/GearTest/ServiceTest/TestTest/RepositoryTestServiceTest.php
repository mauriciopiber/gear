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
    public function createSrc()
    {

    }

    /**
     * @group test-repository-002
     */
    public function createSrcDependency()
    {

    }

    /**
     * @group test-repository-003
     */
    public function createSrcMultiDependency()
    {

    }

    /**
     * @group test-repository-004
     */
    public function createSrcExtends()
    {

    }

    /**
     * @group test-repository-005
     */
    public function createSrcDependencyExtends()
    {

    }
}
