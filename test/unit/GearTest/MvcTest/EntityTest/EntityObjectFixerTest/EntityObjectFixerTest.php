<?php
namespace GearTest\MvcTest\EntityTest\EntityObjectFixerTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObject;
use GearBase\Util\String\StringService;

/**
 * @group Service
 */
class EntityObjectFixerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->stringService =  new StringService;

        $this->service = new EntityObjectFixer(
            $this->stringService
        );

        $this->service->setModuleName('MyModule');
    }

    public function getEntitysFixData()
    {
        return [
            ['upload-image'***REMOVED***,
            ['mvc-basic-upload-image'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider getEntitysFixData
     */
    public function testFixTableEntity($tableName)
    {

        $entity = new EntityObject(__DIR__.'/_files/_mocks/'.$tableName.'.phtml');
        $this->service->fixEntity($entity);
        $this->assertEquals(file_get_contents(__DIR__.'/_files/_expects/'.$tableName.'.phtml'), $entity->getContent());

    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer', $this->service);
    }
}
