<?php
namespace GearTest\ConstructorTest\SrcTest;

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
class SrcControllerTest extends AbstractConsoleControllerTestCase
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
            'Gear\Constructor\Src\SrcController',
            $this->getApplication()->getServiceManager()->get('ControllerManager')->get('Gear\Module\Constructor\Src')
        );
    }

}
