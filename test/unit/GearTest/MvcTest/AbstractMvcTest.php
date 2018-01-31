<?php
namespace GearTest\MvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Mvc\AbstractMvc;
use GearJson\Src\SrcObject;
use Gear\Mvc\Exception\CreateSrcFromAbstractNotAllowed;

class AbstractMvcTest extends TestCase
{
    public function setUp()
    {
        $this->abstractMvc = $this->getMockForAbstractClass(AbstractMvc::class, [***REMOVED***, '', false);
    }

    public function createSrc()
    {
        $src = $this->prophesize(SrcObject::class);

        $this->expectException(CreateSrcFromAbstractNotAllowed::class);

        $this->abstractMvc->create($src);
    }

    public function createDb()
    {

    }

    public function createSrcWithDb()
    {

    }

    public function forceDb()
    {

    }
}
