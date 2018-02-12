<?php
namespace GearTest\TableTest\TableServiceTest;

use PHPUnit\Framework\TestCase;
use Gear\Table\TableService\TableServiceTrait;

/**
 * @group Service
 */
class TableServiceTest extends TestCase
{
    use TableServiceTrait;

    /**
     * @group Gear
     * @group TableService
    */
    public function testSet()
    {
        $mockTableService = $this->prophesize(
            'Gear\Table\TableService\TableService'
        );
        $this->setTableService($mockTableService->reveal());
        $this->assertEquals($mockTableService->reveal(), $this->getTableService());
    }
}
