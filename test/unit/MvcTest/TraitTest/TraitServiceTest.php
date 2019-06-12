<?php
namespace GearTest\ServiceTest\MvcTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Creator\Component\Constructor\ConstructorParams;
use GearTest\UtilTestTrait;
use Gear\Table\TableService\TableService;
use Gear\Util\Dir\DirService;

/**
 * @group mvc-trait
 */
class TraitServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../view');

        $this->templates = $this->baseDir.'/../test/template/module/mvc/trait';

        $this->string  = new \Gear\Util\String\StringService();
        $this->fileCreator    = $this->createFileCreator();

        $code = new \Gear\Creator\Code(
            $this->module->reveal(),
            $this->string
        );
        $code->setDirService(new \Gear\Util\Dir\DirService());
        $constructorParams = new ConstructorParams($this->string);
        $code->setConstructorParams($constructorParams);

        $table = $this->prophesize(TableService::class);
        $dir = $this->prophesize(DirService::class);

        $serviceManager = new \Gear\Mvc\Config\ServiceManager(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string
        );

        $this->trait = new \Gear\Mvc\TraitService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $code,
            $dir->reveal(),
            $table->reveal(),
            $serviceManager
        );
        $this->trait->setServiceManager($serviceManager);
    }

    public function getData()
    {
        return [
            [
                new \Gear\Schema\Src\Src([
                    'name' => 'MyTrait',
                    'type' => 'Repository',
                ***REMOVED***),
                'simple-trait'
            ***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @group src-mvc
     * @dataProvider getData
     */
    public function testCreateSrcTrait($src, $template)
    {

        $this->module->map('Repository')->willReturn(vfsStream::url('module'));

        $file = $this->trait->createTrait($src, vfsStream::url('module'));

        $expected = $this->templates.'/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
