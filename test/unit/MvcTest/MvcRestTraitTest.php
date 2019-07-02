<?php
namespace Gear\Test\MvcTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\MvcRestTrait;
use Gear\Schema\Controller\Controller;
use Gear\Schema\Src\Src;

/**
 *
 */
class MvcRestTraitTest extends TestCase
{
    use MvcRestTrait;


    public function testControllerNotGearRest()
    {
        $controller = new Controller([
          'name' => 'MyController',
          'type' => 'Rest'
        ***REMOVED***);

        $this->assertFalse($this->isRest($controller));
    }

    public function testControllerRest()
    {
        $controller = new Controller([
          'name' => 'MyController',
          'type' => 'Rest',
          'extends' => '\Gear\Rest\Controller\AbstractRestController',
        ***REMOVED***);

        $this->assertTrue($this->isRest($controller));
    }

    public function testRepository()
    {
        $src = new Src([
          'name' => 'MyRepository',
          'type' => 'Repository',
        ***REMOVED***);

        $this->assertFalse($this->isRest($src));
    }

    public function testRestRepository()
    {
        $src = new Src([
          'name' => 'MyRepository',
          'type' => 'Repository',
          'extends' => '\Gear\Rest\Repository\AbstractRestRepository'
        ***REMOVED***);

        $this->assertTrue($this->isRest($src));
    }

    public function testService()
    {
        $src = new Src([
          'name' => 'MyService',
          'type' => 'Service',
        ***REMOVED***);

        $this->assertFalse($this->isRest($src));
    }

    public function testRestService()
    {
        $src = new Src([
          'name' => 'MyService',
          'type' => 'Service',
          'extends' => '\Gear\Rest\Service\AbstractRestService'
        ***REMOVED***);

        $this->assertTrue($this->isRest($src));
    }

    public function testFilter()
    {
        $src = new Src([
          'name' => 'MyFilter',
          'type' => 'Filter',
        ***REMOVED***);

        $this->assertFalse($this->isRest($src));
    }

    public function testRestFilter()
    {
        $src = new Src([
          'name' => 'MyFilter',
          'type' => 'Filter',
          'implements' => '\Gear\Rest\Filter\RestFilterInterface'
        ***REMOVED***);

        $this->assertTrue($this->isRest($src));
    }
}
