<?php
namespace GearTest\IntegrationTest\ComponentTest\GearFileTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Component\GearFile\GearFile;
use GearBase\Util\String\StringService;
use Symfony\Component\Yaml\Yaml;

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


    public function suiteData()
    {
        return [
            //[new SrcMinorSuite(new SrcMajorSuite(), 'service', 1, true), 'src-service.yml'***REMOVED***,
            //[new ControllerMinorSuite(new ControllerMajorSuite(), 'action', 1, true), 'controller-action.yml'***REMOVED***,
            //[new SrcMinorSuite(new SrcMajorSuite(), 'service', 1, false), 'src-service.yml'***REMOVED***,
            //[new ControllerMinorSuite(new ControllerMajorSuite(), 'action', 1, false), 'controller-action.yml'***REMOVED***,
            [new MvcMinorSuite(new MvcMajorSuite('mvc-basic'), 'mvc-basic', 'all', null, null, true), 'mvc-basic.yml'***REMOVED***,
            [new MvcMinorSuite(new MvcMajorSuite('mvc-basic'), 'mvc-basic', 'all', null, null, true), 'mvc-basic.yml'***REMOVED***,
            //[new MvcMinorSuite(new MvcMinorSuite(), 'mvc-basic', 'all', null, null, false), 'mvc-basic.yml'***REMOVED***
            //[new SrcMvcMinorSuite(new SrcMvcMajorSuite()), ''***REMOVED***,
            //[new ControllerMvcMinorSuite(new ControllerMvcMajorSuite()), ''***REMOVED***,
            //[new MvcMinorSuite(new MvcMinorSuite()), ''***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider suiteData
     * @group fix1
     */
    public function testGenerateGearfile($minor, $fileName)
    {
        $this->service->setSuite($minor);

        $data = ['src' => [***REMOVED***, 'controller' => [***REMOVED***, 'db' => [***REMOVED******REMOVED***;

        $this->persist->save($minor, $fileName, Yaml::dump($data))->shouldBeCalled();

        $this->assertEquals($fileName, $this->service->createGearfileComponent($data));
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
