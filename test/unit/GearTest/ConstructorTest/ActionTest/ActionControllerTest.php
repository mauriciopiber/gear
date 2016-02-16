<?php
namespace GearTest\ConstructorTest\ActionTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

/*
 * Feature: Cadastro de Controller no Módulo.
 *   Devemos manipular os arquivos Controller de acordo com o input no sistema.
 */
/**
 * @group controller
 * @group controller
 * @group controller-controller
 */
class ActionControllerTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        $this->bootstrap = new \GearBaseTest\ZendServiceLocator();
        $this->setApplicationConfig(
            include \GearBase\Module::getProjectFolder().'/config/application.config.php'
        );

        parent::setUp();
    }

    public function testControllerManager()
    {
        $this->assertInstanceOf(
            'Gear\Constructor\Action\ActionController',
            $this->getApplication()->getServiceManager()->get('ControllerManager')->get('Gear\Module\Constructor\Action')
        );
    }

}
