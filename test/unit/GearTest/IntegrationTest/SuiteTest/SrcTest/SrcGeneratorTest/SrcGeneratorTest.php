<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest\SrcGeneratorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator;
use Gear\Integration\Suite\Src\SrcMajorSuite;
use Gear\Integration\Suite\Src\SrcMinorSuite;

/**
 * @group Service
 */
class SrcGeneratorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gearFile = $this->prophesize('Gear\Integration\Component\GearFile\GearFile');
        $this->testFile = $this->prophesize('Gear\Integration\Component\TestFile\TestFile');

        $this->service = new SrcGenerator(
            $this->gearFile->reveal(),
            $this->testFile->reveal()
        );
    }

    public function testGenerateGearfileService()
    {
        $expect = [
            [
                [
                    [
                        "name" => "service%sImplements%s%s",
                        "type" => "interface"

                    ***REMOVED***

                ***REMOVED***,
                [""***REMOVED***,
                "service",
                1
            ***REMOVED***,
            [
                [
                    [
                        "name" => "%sImplements%s%s",
                        "implements" => "Interfaces\ServiceInterfaceOne",
                        "type" => "service"

                    ***REMOVED***,
                    [
                        "name" => "%sImplementsMany%s%s",
                        "implements" => "Interfaces\ServiceInterfaceOne",
                        "type" => "service"

                    ***REMOVED***

                ***REMOVED***,
                ["invokables", "factories", "abstract"***REMOVED***,
                "service",
                1
            ***REMOVED***
        ***REMOVED***;


        $majorSuite = $this->prophesize(SrcMajorSuite::class);
        $minorSuite = $this->prophesize(SrcMinorSuite::class);

        $minorSuite->getMajorSuite()->willReturn($majorSuite->reveal());
        $minorSuite->getType()->willReturn('service')->shouldBeCalled();
        $minorSuite->getRepeat()->willReturn(1)->shouldBeCalled();
        $minorSuite->isUsingLongName()->willReturn(true)->shouldBeCalled();

        $this->gearFile->createSrcGearfile($minorSuite, $expect)->willReturn('src-service.yml')->shouldBeCalled();
        $this->gearFile->createMultiplesInterfaces('service', 1, 1, 'long')->willReturn('Interfaces\ServiceInterfaceOne')->shouldBeCalled();

        $minorSuite->setGearFile('src-service.yml')->shouldBeCalled();

        $this->service->generateMinorSuite($minorSuite->reveal());



    }
}
