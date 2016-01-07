<?php
namespace GearTest\ConstructorTest\BuilderTest\ControllerActionTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Builder
 */
class ControllerActionTest extends AbstractTestCase 
{

    public function testCanMock()
    {
        $controllerAction = $this->getMockSingleClass(
            'Gear\Constructor\Builder\ControllerAction\ControllerAction',
            ['build'***REMOVED***
        );
        
        $this->assertEquals(
            'Gear\Constructor\Builder\ControllerAction\ControllerAction',
            $controllerAction->getClassName()
        );
    }
    
    public function providerClass()
    {
        return <<<EOS
<?php
namespace Constructor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CreateController extends AbstractActionController
{

}

EOS;
        
    }
    
    
    public function testAddFunctionsToFile()
    {
        $class = $this->providerClass();
        
        $functions = <<<EOS

    public function primeiraAtividadeAction()
    {
        return new ViewModel(
            array(
            )
        );
    }
}

EOS;

        
        $classWellFormed = <<<EOS
<?php
namespace Constructor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CreateController extends AbstractActionController
{


    public function primeiraAtividadeAction()
    {
        return new ViewModel(
            array(
            )
        );
    }
}


EOS;
        
        $controllerAction = $this->getMockSingleClass(
            'Gear\Constructor\Builder\ControllerAction\ControllerAction',
            ['loadFileIntoText', 'diffFunctions'***REMOVED***
        );

        
        $controllerAction->expects($this->any())->method('loadFileIntoText')->willReturn($class);
        $controllerAction->expects($this->any())->method('diffFunctions')->willReturn($functions);
        $this->assertEquals($classWellFormed, $controllerAction->addDiffToFile());
    }
    
    
    public function testDiffToFileTwoFunctions()
    {
        $class = $this->providerClass();
        
        
        $functions = <<<EOS

    public function primeiraAtividadeAction()
    {
        return new ViewModel(
            array(
            )
        );
    }

    public function segundaAtividadeAction()
    {
        return new ViewModel(
            array(
            )
        );
    }
}

EOS;
        
        $classWellFormed = <<<EOS
<?php
namespace Constructor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CreateController extends AbstractActionController
{


    public function primeiraAtividadeAction()
    {
        return new ViewModel(
            array(
            )
        );
    }

    public function segundaAtividadeAction()
    {
        return new ViewModel(
            array(
            )
        );
    }
}


EOS;
        
                
        $controllerAction = $this->getMockSingleClass(
            'Gear\Constructor\Builder\ControllerAction\ControllerAction',
            ['loadFileIntoText', 'diffFunctions'***REMOVED***
        );
        

        $controllerAction->expects($this->any())->method('loadFileIntoText')->willReturn($class);
        $controllerAction->expects($this->any())->method('diffFunctions')->willReturn($functions);
        
       
       
        $this->assertEquals($classWellFormed, $controllerAction->addDiffToFile());
        
    }
    
    public function testInsertFunctionIntoClassWithFunction()
    {
        
        $class = <<<EOS
<?php
namespace Constructor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CreateController extends AbstractActionController
{


    public function primeiraAtividadeAction()
    {
        return new ViewModel(
            array(
            )
        );
    }
}
       

EOS;

    }
    
    
}

