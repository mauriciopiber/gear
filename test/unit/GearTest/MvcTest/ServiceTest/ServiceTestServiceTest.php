<?php
namespace GearTest\MvcTest\ServiceTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\HelperPluginManager;
use PhpParser\ParserFactory;
use GearTest\AllColumnsDbMockTrait;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-service
 * @group module-mvc-service-service-test
 */
class ServiceTestServiceTest extends AbstractTestCase
{
    use AllColumnsDbMockTrait;

    public function testServiceManager()
    {
        $this->assertInstanceOf(
            'Gear\Mvc\Service\ServiceTestService',
            $this->getServiceLocator()->get('Gear\Mvc\Service\ServiceTestService')
        );
    }

    public function getServiceManagerMock($moduleName)
    {

        $serviceManager = new \Zend\ServiceManager\ServiceManager();

        $stringService = new \GearBase\Util\String\StringService();
        $serviceManager->setService('GearBase\Util\String', $stringService);

        vfsStream::setup('moduleDir');

        $module = $this->getMockBuilder('Gear\Module\BasicModuleStructure')
        ->disableOriginalConstructor()
        ->setMethods(['getModuleName', 'getTestServiceFolder'***REMOVED***)
        ->getMock();

        $module->expects($this->any())->method('getModuleName')->willReturn($moduleName);
        $module->expects($this->any())->method('getTestServiceFolder')->willReturn(vfsStream::url('moduleDir'));

        $serviceManager->setService('moduleStructure', $module);

        $codeTest = new \Gear\Creator\CodeTest();
        $codeTest->setServiceLocator($serviceManager);
        $serviceManager->setService('Gear\Creator\CodeTest', $codeTest);

        $codeSrc = new \Gear\Creator\SrcDependency();
        $codeSrc->setServiceLocator($serviceManager);
        $serviceManager->setService('Gear\Creator\Src', $codeSrc);

        $serviceManagerConfig = new \Gear\Mvc\Config\ServiceManager();
        $serviceManagerConfig->setServiceLocator($serviceManager);
        $serviceManager->setService('Gear\Mvc\Config\ServiceManager', $serviceManagerConfig);

        $fileService = new \GearBase\Util\File\FileService();
        $fileService->setServiceLocator($serviceManager);

        $helpers = new HelperPluginManager();

        $view = new PhpRenderer();
        $view->setHelperPluginManager($helpers);

        $resolver = new AggregateResolver();

        $map = new TemplatePathStack(array(
            'script_paths' => array(
                'template' => \GearBase\Module::getProjectFolder().'/view',
            )
        ));

        $resolver->attach($map);

        $view->setResolver($resolver);

        $template = new \Gear\Creator\TemplateService();
        $template->setServiceLocator($serviceManager);
        $template->setRenderer($view);

        $fileCreator = new \Gear\Creator\File($fileService, $template);

        $serviceManager->setService('Gear\FileCreator', $fileCreator);

        return $serviceManager;
    }

    /*
    public function testCreateSrc()
    {
        $moduleName = 'ModuleTest';
        $name = 'CreateSrc';
        $type = 'Service';

        $src = $this->getMockBuilder('GearJson\Src\Src')
        ->disableOriginalConstructor()
        ->setMethods(['getName', 'getType'***REMOVED***)
        ->getMock();

        $src->expects($this->any())->method('getName')->willReturn($name);
        $src->expects($this->any())->method('getType')->willReturn($type);

        $serviceManager = $this->getServiceManagerMock($moduleName);

        $serviceTest = new \Gear\Mvc\Service\ServiceTestService();
        $serviceTest->setServiceLocator($serviceManager);

        $file = $serviceTest->create($src);

        $this->assertTrue(is_file('vfs://moduleDir/'.$name.'Test.php'));

        $code = file_get_contents('vfs://moduleDir/'.$name.'Test.php');


        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);

        $stmts = $parser->parse($code);

        $this->assertEquals([$moduleName.'Test', $type.'Test'***REMOVED***, $stmts[0***REMOVED***->name->parts);
    }
    */


    /**
     * @group large-size
     */
    public function testCreateDb()
    {
        $moduleName = 'ModuleTest';
        $tableName = 'AllColumnsDb';
        $columns = [***REMOVED***;


        $tableObject = $this->getAllColumnsDbMock();

        $serviceManager = $this->getServiceManagerMock($moduleName);

        $metadata = $this->getMockBuilder('Zend\Db\Metadata\Metadata')
        ->disableOriginalConstructor()
        ->setMethods(['getColumns', 'getTable'***REMOVED***)
        ->getMock($tableObject->getColumns());

        $metadata->expects($this->any())->method('getColumns')->willReturn($tableObject->getColumns());
        $metadata->expects($this->any())->method('getTable')->willReturn($tableObject);

        $serviceManager->setService('Gear\Factory\Metadata', $metadata);

        $table = $this->getMockBuilder('Gear\Metadata\Table')
        ->disableOriginalConstructor()
        ->setMethods(['getTable'***REMOVED***)
        ->getMock();

        $table->expects($this->any())->method('getTable')->willReturn($tableObject);

        $serviceManager->setService('Gear\Metadata\Table', $table);

        $tableService = $this->getMockBuilder('Gear\Table\TableService')
        ->disableOriginalConstructor()
        ->setMethods(['getPrimaryKeyColumns', 'getPrimaryKey'***REMOVED***)
        ->getMock();

        $tableService->setServiceLocator($serviceManager);

        $tableService->expects($this->any())->method('getPrimaryKeyColumns')->willReturn(['id_all_columns_db'***REMOVED***);
        $tableService->expects($this->any())->method('getPrimaryKey')->willReturn($this->getPrimaryKey());

        $serviceManager->setService('Gear\Table\TableService', $tableService);


        $srcName = 'AllColumnsDbService';
        $type = 'Service';

        $src = $this->getMockBuilder('GearJson\Src\Src')
        ->disableOriginalConstructor()
        ->setMethods(['getName', 'getType'***REMOVED***)
        ->getMock();

        $src->expects($this->any())->method('getName')->willReturn($srcName);
        $src->expects($this->any())->method('getType')->willReturn($type);


        $schemaService = $this->getMockBuilder('GearJson\Schema\SchemaService')
        ->disableOriginalConstructor()
        ->setMethods(['getSrcByDb'***REMOVED***)
        ->getMock();

        $schemaService->expects($this->at(0))->method('getSrcByDb')->willReturn($src);

        $serviceManager->setService('GearJson\Schema', $schemaService);


        $columnService = $this->getMockBuilder('Gear\Column\ColumnService')
        ->disableOriginalConstructor()
        ->setMethods(['verifyColumnAssociation'***REMOVED***)
        ->getMock();

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        $serviceManager->setService('memcached', $cache);

        $columnService->setServiceLocator($serviceManager);

        $columnService->expects($this->any())->method('verifyColumnAssociation')->willReturn(false);

        $serviceManager->setService('Gear\Column\ColumnService', $columnService);

        $serviceTest = new \Gear\Mvc\Service\ServiceTestService();
        $serviceTest->setServiceLocator($serviceManager);

        $db = $this->getMockBuilder('GearJson\Db\Db')
        ->disableOriginalConstructor()
        ->setMethods(['getTable', 'getColumns'***REMOVED***)
        ->getMock();

        $db->expects($this->any())->method('getTable')->willReturn($tableName);
        $db->expects($this->any())->method('getColumns')->willReturn($columns);

        $file = $serviceTest->introspectFromTable($db);

        //$this->assertTrue($file);
        $this->assertTrue(is_file('vfs://moduleDir/'.$srcName.'Test.php'));

        $code = file_get_contents('vfs://moduleDir/'.$srcName.'Test.php');

        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);

        $stmts = $parser->parse($code);

        $this->assertEquals([$moduleName.'Test', $type.'Test'***REMOVED***, $stmts[0***REMOVED***->name->parts);

    }
}
