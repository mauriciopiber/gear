<?php
namespace GearTest\IntegrationTest\UtilTest\ResolveNamesTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Util\ResolveNames\ResolveNames;
use Gear\Integration\Suite\Src\SrcMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\Src\SrcMajorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;
use Gear\Integration\Suite\Controller\ControllerMajorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMajorSuite;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;

/**
 * @group Service
 */
class ResolveNamesTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');

        $this->service = new ResolveNames($this->stringService->reveal());
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Util\ResolveNames\ResolveNames', $this->service);
    }

    public function testDataSuite()
    {
        $this->mvcMajor =


        return [
            // [new SrcMinorSuite(new SrcMajorSuite(), 'service', 1, true), 'src-service.yml'***REMOVED***,
            // [new ControllerMinorSuite(new ControllerMajorSuite(), 'action', 1, true), 'controller-action.yml'***REMOVED***,
            // [new SrcMinorSuite(new SrcMajorSuite(), 'service', 1, false), 'src-service.yml'***REMOVED***,
            // [new ControllerMinorSuite(new ControllerMajorSuite(), 'action', 1, false), 'controller-action.yml'***REMOVED***,
            [
                new MvcMinorSuite(new MvcMajorSuite('mvc-basic'), 'mvc-basic', 'all', null, null, false),
                'MvcBasic'
            ***REMOVED***
            [
                new MvcMinorSuite(new MvcMajorSuite('mvc-basic'), 'mvc-basic', 'all', null, null, true),
                'MvcBasic'
            ***REMOVED***,
            [
                new MvcMinorSuite(new MvcMajorSuite('mvc-basic'), 'mvc-basic', 'low-strict', 'unique', 'upload-image', true),
                'mvc-basic-low-strict-unique-upload-image'
            ***REMOVED***,
            [
                new MvcMinorSuite(new MvcMajorSuite('mvc-basic'), 'mvc-basic', 'low-strict', 'unique', 'upload-image', false),
                'mvc-basic.yml'
            ***REMOVED***,
            // [new MvcMinorSuite(new MvcMinorSuite(), 'mvc-basic', 'all', null, null, false), 'mvc-basic.yml'***REMOVED***
            // [new SrcMvcMinorSuite(new SrcMvcMajorSuite()), ''***REMOVED***,
            // [new ControllerMvcMinorSuite(new ControllerMvcMajorSuite()), ''***REMOVED***,
            // [new MvcMinorSuite(new MvcMinorSuite()), ''***REMOVED***
        ***REMOVED***;
    }

    public function testCreateTableName()
    {}
}
