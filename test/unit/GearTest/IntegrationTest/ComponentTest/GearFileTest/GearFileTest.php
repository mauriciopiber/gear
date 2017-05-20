<?php
namespace GearTest\IntegrationTest\ComponentTest\GearFileTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Component\GearFile\GearFile;
use GearBase\Util\String\StringService;

/**
 * @group Service
 */
class GearFileTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->persist = $this->prophesize('Gear\Integration\Util\Persist\Persist');
        $this->stringService = new StringService();

        $this->service = new GearFile(
            $this->persist->reveal(),
            $this->stringService
        );

        $this->suite = $this->prophesize('Gear\Integration\Suite\MinorSuiteInterface');
        $this->suite->isUsingLongName()->willReturn(true);
    }

    public function testCreateSingleInterface()
    {
        $data = $this->service->createMultiplesImplements($this->suite->reveal(), 'service', 1, 1, 'long');

        $this->assertEquals(['Interfaces\ServiceInterface'***REMOVED***, $data);
    }

    public function testCreateMultipleInterfaceUsingService()
    {
        $data = $this->service->createMultiplesImplements($this->suite->reveal(), 'service', 5, 5, 'long');

        $this->assertEquals([
            'Interfaces\ServiceInterfaceOne',
            'Interfaces\ServiceInterfaceTwo',
            'Interfaces\ServiceInterfaceThree',
            'Interfaces\ServiceInterfaceFour',
            'Interfaces\ServiceInterfaceFive',
        ***REMOVED***, $data);
    }


    public function testCreateMultipleInterfaceUsingRepository()
    {
        $data = $this->service->createMultiplesImplements($this->suite->reveal(), 'repository', 5, 5, 'short');

        $this->assertEquals([
            'Interfaces\RepositoryInterOne',
            'Interfaces\RepositoryInterTwo',
            'Interfaces\RepositoryInterThree',
            'Interfaces\RepositoryInterFour',
            'Interfaces\RepositoryInterFive',
        ***REMOVED***, $data);
    }
}
