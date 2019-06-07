<?php
namespace GearTest\CodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Code\NamespaceForward;

class NamespaceForwardTest extends TestCase
{
    public function setUp() : void
    {
        $this->service = new NamespaceForward();
    }

    public function testFixGistWithProphesize()
    {
        $data = file_get_contents(__DIR__.'/expect/prophesize/to-extract.txt');

        $result = $this->service->format($data);

        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('use', $result);

        $this->assertEquals([
            'use Gear\Schema\Schema\SchemaService;',
            'use Gear\Schema\Schema\Loader\SchemaLoaderService;',
            'use Gear\Schema\Controller\ControllerSchema;',
            'use Gear\Schema\Action\ActionSchema;',
            'use Gear\Mvc\ConsoleController\ConsoleControllerTest;',
            'use Gear\Mvc\ConsoleController\ConsoleController;'
        ***REMOVED***, $result['use'***REMOVED***);

        $this->assertArrayHasKey('code', $result);

        $this->assertEquals(file_get_contents(__DIR__.'/expect/prophesize/fixed.txt'), $result['code'***REMOVED***);
    }

    /**
     * @group x1
     */
    public function testFixGistWithInstance()
    {
        $data = file_get_contents(__DIR__.'/expect/instance/to-extract.txt');

        $result = $this->service->format($data);

        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('use', $result);

        $this->assertEquals([
            'use Gear\Creator\Template\TemplateService;',
            'use Gear\Util\File\FileService;',
            'use Gear\Util\String\StringService;',
            'use Gear\Creator\FileCreator\FileCreator;',
            'use Gear\Util\Dir\DirService;'
        ***REMOVED***, $result['use'***REMOVED***);

        $this->assertArrayHasKey('code', $result);

        $this->assertEquals(file_get_contents(__DIR__.'/expect/instance/fixed.txt'), $result['code'***REMOVED***);
    }
}
