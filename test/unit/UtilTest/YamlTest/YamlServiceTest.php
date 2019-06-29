<?php
namespace GearTest\UtilTest\YamlTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Yaml\YamlService;
use Gear\Util\Yaml\YamlServiceTrait;
use org\bovigo\vfs\vfsStream;

/**
 * @group Util
 */
class YamlServiceTest extends TestCase
{
    use YamlServiceTrait;

    public function testThrowFileNotFound()
    {
        $yaml = new YamlService();

        $file = null;

        $this->expectException('Gear\Util\Yaml\Exception\YamlNotFoundException');

        $yaml->load($file);
        //$this->
    }

    public function testLoad()
    {
        $root = vfsStream::setup('yaml');

        $gearfile = vfsStream::url('yaml/example.yml');

        $gearfileConfig = <<<EOS
file: one
dir: two
time: three
life: four
options:
  date: one
  more:
    date: now
EOS;

        file_put_contents($gearfile, $gearfileConfig);


        $yaml = new YamlService();

        $file = $yaml->load($gearfile);

        $this->assertEquals($file['file'***REMOVED***, 'one');
        $this->assertEquals($file['dir'***REMOVED***, 'two');
        $this->assertEquals($file['time'***REMOVED***, 'three');
        $this->assertEquals($file['life'***REMOVED***, 'four');

        $this->assertEquals($file['options'***REMOVED***, [
            'date' => 'one',
            'more' => ['date' => 'now'***REMOVED***
        ***REMOVED***);

    }

    public function testParseYaml()
    {
        $yamlFile = <<<EOS
file: one
dir: two
time: three
life: four
options:
  date: one
  more:
    date: now
EOS;


        $yaml = new YamlService();

        $file = $yaml->parse($yamlFile);


        $this->assertEquals($file['file'***REMOVED***, 'one');
        $this->assertEquals($file['dir'***REMOVED***, 'two');
        $this->assertEquals($file['time'***REMOVED***, 'three');
        $this->assertEquals($file['life'***REMOVED***, 'four');

        $this->assertEquals($file['options'***REMOVED***, [
           'date' => 'one',
           'more' => ['date' => 'now'***REMOVED***
        ***REMOVED***);

    }

    /**
     * @group Gear
     * @group YamlService
    */
    public function testSet()
    {
        $mockYamlService = $this->prophesize(
            'Gear\Util\Yaml\YamlService'
        );
        $this->setYamlService($mockYamlService->reveal());
        $this->assertEquals($mockYamlService->reveal(), $this->getYamlService());
    }
}
