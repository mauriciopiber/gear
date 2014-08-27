<?php
use Gear\Model\HtmlTableGear;

class HtmlTableGearTest extends PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $this->entity      = new HtmlTableGear();
    	parent::setUp();
    }
    
    public function testShouldCreateTableHead()
    {
         $this->assertTrue(is_string($this->entity->getTableHead()));
    }
    
    public function testShouldCreateTableFooter()
    {
        $this->assertTrue(is_string($this->entity->getTableFooter()));
    }
    
    public function testShouldCreateTableBody()
    {
        $this->assertTrue(is_string($this->entity->getTableBody()));
    }
    
    public function testShouldCreateTable()
    {
        $this->assertTrue(is_string($this->entity->putTable()));
    }
    
    public function testShouldCreateTableFile()
    {
    	
    }
}    