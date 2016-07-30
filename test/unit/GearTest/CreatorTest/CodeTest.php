<?php
namespace GearTest\CreatorTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group RefactoringSrc
 * @group Code
 */
class CodeTest extends AbstractTestCase
{
    public function getData()
    {
        return [
            [
                new \GearJson\Src\Src(['name' => 'Test', 'type' => 'Service'***REMOVED***),
                null
           ***REMOVED***,
            [
                new \GearJson\Src\Src(['name' => 'Test', 'type' => 'Service', 'implements' => 'Repository\ImplementsInterface'***REMOVED***),
                'implements MyModule\Repository\ImplementsInterface'."\n",
            ***REMOVED***,

        ***REMOVED***;
    }

    /**
     * @dataProvider getData
     */
    public function testImplements($src, $template = null)
    {
        $code = new \Gear\Creator\Code();
        $this->assertEquals($template, $code->getImplements($src));
    }
}
