<?php
namespace GearTest\ConstructorTest\SrcTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\Console\Request;
use Gear\Constructor\Src\SrcController;
use Zend\View\Model\ConsoleModel;
use Gear\Module\Constructor\Src;
use Gear\Constructor\Src\SrcConstructor;
use Zend\Router\RouteMatch;

/*
 * Feature: Cadastro de Controller no Módulo.
 *   Devemos manipular os arquivos Controller de acordo com o input no sistema.
 */
/**
 * @group module
 * @group module-constructor
 * @group module-constructor-db
 * @group module-constructor-db-controller
 */
class SrcControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->dbConstructor = $this->prophesize(SrcConstructor::class);

        $this->controller = new SrcController(
            $this->dbConstructor->reveal()
        );
    }

    public function testCreateSrc()
    {
        $request = new Request();

        // Configurar Parâmetros de Despacho
        $this->controller->getEvent()->setRouteMatch(new RouteMatch([
            'action' => 'create',
        ***REMOVED***));

        $action = $this->controller->dispatch($request);

        $this->assertInstanceOf(ConsoleModel::class, $action);
    }

    public function testDeleteSrc()
    {
        $action = $this->controller->deleteAction();

        $this->assertInstanceOf(ConsoleModel::class, $action);
    }

}
