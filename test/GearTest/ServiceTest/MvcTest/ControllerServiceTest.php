<?php
namespace GearTest\ServiceTest\MvcServiceTest;

use GearTest\ServiceTest\AbstractServiceTest;

/**
 * @group refactory
 *
 * @author piber
 *
 */
class ControllerServiceTest extends AbstractServiceTest
{
    use \Gear\Common\ControllerServiceTrait;

    public function testCreateDbController()
    {
        $this->mockDb();

        $dependency = [
            "Factory\Columns",
            "Service\Columns",
            "SearchFactory\Columns"
        ***REMOVED***;




        $mockCreateAction = $this->getMockSingleClass('Gear\ValueObject\Action', array(
            'getName',
            'getDependency'
        ));
        $mockCreateAction->expects($this->any())
            ->method('getName')
            ->willReturn('Create');

        $mockCreateAction->expects($this->any())
        ->method('getDependency')
        ->willReturn($dependency);


        $mockEditAction = $this->getMockSingleClass('Gear\ValueObject\Action', array(
            'getName',
            'getDependency'
        ));
        $mockEditAction->expects($this->any())
            ->method('getName')
            ->willReturn('Edit');
        $mockEditAction->expects($this->any())
        ->method('getDependency')
        ->willReturn($dependency);



        $mockListAction = $this->getMockSingleClass('Gear\ValueObject\Action', array(
            'getName',
            'getDependency'
        ));
        $mockListAction->expects($this->any())
            ->method('getName')
            ->willReturn('List');
        $mockListAction->expects($this->any())
        ->method('getDependency')
        ->willReturn($dependency);


        $mockDeleteAction = $this->getMockSingleClass('Gear\ValueObject\Action', array(
            'getName',
            'getDependency'
        ));
        $mockDeleteAction->expects($this->any())
            ->method('getName')
            ->willReturn('Delete');
        $mockDeleteAction->expects($this->any())
        ->method('getDependency')
        ->willReturn($dependency);

        $mockViewAction = $this->getMockSingleClass('Gear\ValueObject\Action', array(
            'getName',
            'getDependency'
        ));
        $mockViewAction->expects($this->any())
            ->method('getName')
            ->willReturn('View');
        $mockViewAction->expects($this->any())
        ->method('getDependency')
        ->willReturn($dependency);

        $mockServiceManager = $this->getMockSingleClass('Gear\ValueObject\ServiceManager', array(
            'getService',
            'getObject'
        ));
        $mockServiceManager->expects($this->any())
            ->method('getService')
            ->willReturn('invokables');
        $mockServiceManager->expects($this->any())
            ->method('getObject')
            ->willReturn('%s\Controller\Columns');

        $mockController = $this->getMockSingleClass('Gear\ValueObject\Controller', array(
            'getService',
            'getActions',
            'getName'
        ));

        $mockController->expects($this->any())
            ->method('getService')
            ->willReturn($mockServiceManager);

        $mockController->expects($this->any())
            ->method('getActions')
            ->willReturn(array(
            $mockCreateAction,
            $mockEditAction,
            $mockListAction,
            $mockViewAction,
            $mockDeleteAction
        ));

        $mockController->expects($this->any())
            ->method('getName')
            ->willReturn('ColumnsController');

        $this->schema->expects($this->any())->method('getControllerByDb')->willReturn($mockController);

        $this->module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getControllerFolder', 'getModuleName'));
        $this->module->expects($this->any())->method('getModuleName')->willReturn('Column');
        $this->module->expects($this->any())->method('getControllerFolder')->willReturn(__DIR__.'/_files/');

        $this->getControllerService()->setGearSchema($this->schema);
        $this->getControllerService()->setModule($this->module);
        $this->getControllerService()->setFile($this->file);


        $file = $this->getControllerService()->introspectFromTable($this->db);


        $fileCreated = file_get_contents($file);

        $fileTemp = file_get_contents(__DIR__.'/_files/controller-template-columns.phtml');

        $this->assertEquals($fileTemp, $fileCreated);
    }
}
