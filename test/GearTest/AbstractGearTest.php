<?php
namespace GearTest;

abstract class AbstractGearTest extends AbstractTestCase
{
    protected $serviceLocator;
    protected $moduleMock;
    protected $tempMock;

    public function setUp()
    {
        parent::setUp();

        $this->bootstrap = new \GearTest\Bootstrap();
        $this->setServiceLocator($this->bootstrap->getServiceManager());

        $dirService = $this->bootstrap->getServiceLocator()->get('dirService');
        $dirService->mkDir($this->getTempMock());
        $dirService->mkDir($this->getTempMock().'/schema');

        $this->getServiceLocator()->get('serviceManager')->setAllowOverride(true);
        $this->getServiceLocator()->get('serviceManager')->setService('moduleConfig', $this->getMockConfig());
    }

    public function tearDown()
    {
        $moduleService = $this->getServiceLocator()->get('moduleService');
        $moduleService->setConfig($this->getMockConfig());
        $moduleService->delete();
        parent::tearDown();
    }

    public function setTempMock($tempMock)
    {
        if (!is_dir($tempMock)) {
            throw new \Exception(sprintf('Trying to test without a valid dir on %s', $tempMock));
        }
        $this->tempMock = $tempMock;
        return $this;
    }

    public function getTempMock()
    {
        if (!isset($this->tempMock)) {
            $this->tempMock = __DIR__.'/../temp';
        }
        return $this->tempMock;
    }

    public function getModuleMock()
    {
        if (!isset($this->moduleMock)) {
            $this->moduleMock = 'ModuleTest';
        }
        return $this->moduleMock;
    }

    public function setModuleMock($moduleMock)
    {
        $this->moduleMock = $moduleMock;
        return $this;
    }

    public function getMockConfig($dir = null)
    {
        if (empty($dir)) {
            $dir = $this->getTempMock();
        }

        $mockConfig = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->getMock();
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue($this->getModuleMock()));

        $mockConfig->expects($this->any())
        ->method('getModuleFolder')
        ->will($this->returnValue($dir));

        return $mockConfig;
    }

    public function getMockTemplate()
    {
        $mockTemplate = $this->getMockBuilder('Gear\Service\TemplateService')->getMock();

        $mockTemplate->expects($this->any())
        ->method('render')
        ->willReturn(true);

        return $mockTemplate;
    }



    public function getDefaultForeignKey()
    {
        return $this->mockForeignKeyConstraint('foreign_key_1', array('id_teste'), 'my_another_table', array('id_my_another_table'), 'CASCADE', 'CASCADE');
    }

    public function getWrongForeignKey()
    {
        return $this->mockForeignKeyConstraint('foreign_key_1', array('id_wrong_identifier'), 'my_another_table', array('id_my_another_table'), 'CASCADE', 'CASCADE');
    }

    public function mockForeignKeyConstraint($name, $columns, $referencedTable, $referencedColumns, $updateRule, $deleteRule)
    {
        $mockColumns = $this->getMockBuilder('Zend\Db\Metadata\Object\ConstraintObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockColumns->expects($this->any())
        ->method('getName')
        ->will($this->returnValue($name));

        $mockColumns->expects($this->any())
        ->method('getType')
        ->will($this->returnValue('FOREIGN KEY'));

        $mockColumns->expects($this->any())
        ->method('getColumns')
        ->will($this->returnValue($columns));

        $mockColumns->expects($this->any())
        ->method('getReferencedTableName')
        ->will($this->returnValue($referencedTable));

        $mockColumns->expects($this->any())
        ->method('getReferencedColumns')
        ->will($this->returnValue($referencedColumns));

        $mockColumns->expects($this->any())
        ->method('getUpdateRule')
        ->will($this->returnValue($updateRule));

        $mockColumns->expects($this->any())
        ->method('getDeleteRule')
        ->will($this->returnValue($deleteRule));

        return $mockColumns;
    }


    public function getDefaultColumnByDataType($dataType)
    {
        $mockColumns = $this->getMockBuilder('Zend\Db\Metadata\Object\ColumnObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockColumns->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('id_teste'));

        $mockColumns->expects($this->any())
        ->method('getTableName')
        ->will($this->returnValue('table_teste'));

        $mockColumns->expects($this->any())
        ->method('isNullable')
        ->will($this->returnValue(false));

        $mockColumns->expects($this->any())
        ->method('getDataType')
        ->will($this->returnValue($dataType));


        return $mockColumns;
    }


}
