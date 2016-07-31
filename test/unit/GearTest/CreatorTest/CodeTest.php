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
                [***REMOVED***,
                PHP_EOL
            ***REMOVED***,
            [
                new \GearJson\Src\Src(['name' => 'Test', 'type' => 'Service', 'implements' => 'Repository\ImplementsInterface'***REMOVED***),
                [***REMOVED***,
                ' implements ImplementsInterface'."\n",
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => 'Test',
                        'type' => 'Service',
                        'implements' => ['Repository\ImplementsInterface', 'Repository\SecondInterface'***REMOVED***
                    ***REMOVED***
                ),
                [***REMOVED***,
                ' implements'."\n".'    ImplementsInterface,'."\n".'    SecondInterface'."\n",
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => 'Test',
                        'type' => 'Service',
                        'implements' => ['Repository\ImplementsInterface', 'Repository\SecondInterface'***REMOVED***
                    ***REMOVED***
                ),
                ['ModuleOne\MyThirdInterface', 'ModuleTwo\MyFourInterface'***REMOVED***,
                ' implements'."\n".'    MyThirdInterface,'."\n".'    MyFourInterface,'."\n".'    ImplementsInterface,'."\n".'    SecondInterface'."\n",
            ***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider getData
     */
    public function testImplements($src, $additional, $template = null)
    {
        $code = new \Gear\Creator\Code();
        $this->assertEquals($template, $code->getImplements($src, $additional));
    }
}
