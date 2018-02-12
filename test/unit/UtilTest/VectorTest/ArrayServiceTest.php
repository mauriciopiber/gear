<?php
namespace GearTest\Util\Vector;

use PHPUnit\Framework\TestCase;
use Gear\Util\Vector\ArrayServiceTrait;

/**
 * @group Array
 * @group Service
 * @group Util
 */
class ArrayServiceTest extends TestCase
{
    use ArrayServiceTrait;

    /**
     * @group Gear
     * @group ArrayService
    */
    public function testSet()
    {
        $mockArrayService = $this->prophesize(
            'Gear\Util\Vector\ArrayService'
        );
        $this->setArrayService($mockArrayService->reveal());
        $this->assertEquals($mockArrayService->reveal(), $this->getArrayService());
    }


    public function testReplaceLine()
    {

        $arrayService = new \Gear\Util\Vector\ArrayService();

        $oldArray = [
            'a', 'b', 'c', 'd', 'e', 'f'
        ***REMOVED***;

        $replace = [
            'aa', 'bb', 'cc', 'dd'
        ***REMOVED***;

        $expected = [
            'a', 'b', 'c', 'aa', 'bb', 'cc', 'dd', 'e', 'f'
        ***REMOVED***;


        $this->assertEquals($expected, $arrayService->replaceLine($oldArray, 3, $replace));
    }


    public function testMove()
    {
        $arrayService = new \Gear\Util\Vector\ArrayService();

        $oldArray = [
            'a', 'b', 'c', 'd', 'e', 'f'
        ***REMOVED***;

        $replace = [
            'aa', 'bb', 'cc', 'dd'
        ***REMOVED***;

        $expected = [
            'a', 'b', 'c', 'aa', 'bb', 'cc', 'dd','d', 'e', 'f'
        ***REMOVED***;

        $this->assertEquals($expected, $arrayService->moveArray($oldArray, 3, $replace));
    }

    public function testReplaceRange()
    {
        $arrayService = new \Gear\Util\Vector\ArrayService();

        $oldArray = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i'
        ***REMOVED***;

        $replace = [
            'aa', 'bb', 'cc', 'dd'
        ***REMOVED***;

        $expected = [
            'a', 'b', 'c', 'aa', 'bb', 'cc', 'dd', 'f', 'g', 'h', 'i'
        ***REMOVED***;

        $this->assertEquals($expected, $arrayService->replaceRange($oldArray, 3, 2, $replace));
    }

    public function testArrayToJson()
    {
        $array = [
            'value' => 1,
            'another-value' => 2,
            'then' => 3,
            'four' => 'me'
        ***REMOVED***;


        $arrayService = new \Gear\Util\Vector\ArrayService();

        $expected = <<<EOS
    "value": "1",
    "another-value": "2",
    "then": "3",
    "four": "me"

EOS;

        $this->assertEquals($expected, $arrayService->toJson($array, 1));


        $expected = <<<EOS
        "value": "1",
        "another-value": "2",
        "then": "3",
        "four": "me"

EOS;

        $this->assertEquals($expected, $arrayService->toJson($array, 2));

    }

}
