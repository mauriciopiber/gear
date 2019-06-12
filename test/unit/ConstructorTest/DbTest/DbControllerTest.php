<?php
namespace GearTest\ConstructorTest\DbTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\Console\Request;
use Gear\Constructor\Db\DbController;
use Zend\View\Model\ConsoleModel;
use Gear\Module\Constructor\Db;
use Gear\Constructor\Db\DbConstructor;
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
class DbControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->dbConstructor = $this->prophesize(DbConstructor::class);

        $this->controller = new DbController(
            $this->dbConstructor->reveal()
        );
    }

    public function testCreateDb()
    {
        $request = new Request();

        // Configurar Parâmetros de Despacho
        $this->controller->getEvent()->setRouteMatch(new RouteMatch([
            'action' => 'create',
        ***REMOVED***));

        $action = $this->controller->dispatch($request);

        $this->assertInstanceOf(ConsoleModel::class, $action);
    }

    public function testDeleteDb()
    {
        $action = $this->controller->deleteAction();

        $this->assertInstanceOf(ConsoleModel::class, $action);
    }

}
