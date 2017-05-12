<?php
namespace Gear\Mvc\ValueObject;

use Gear\Module\ModuleAwareInterface;
use GearBase\Util\String\StringServiceTrait;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Module\ModuleAwareTrait;
use GearBase\Util\String\StringService;
use Gear\Creator\File;
use Gear\Creator\CodeTest;
use Gear\Creator\CodeTestTrait;
use GearJson\Src\Src;
use Gear\Module\BasicModuleStructure;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Mvc/ValueObject
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ValueObjectTestService implements ModuleAwareInterface
{
    use StringServiceTrait;

    use FileCreatorTrait;

    use ModuleAwareTrait;

    use CodeTestTrait;

    /**
     * Constructor
     *
     * @param StringService $stringService String Service
     * @param FileCreator   $fileCreator   File Creator
     * @param ModuleAware   $module        Module Aware
     *
     * @return \Gear\Mvc\ValueObject\ValueObjectTestService
     */
    public function __construct(
        StringService $stringService,
        File $fileCreator,
        BasicModuleStructure $module,
        CodeTest $codeTest
    ) {

        $this->stringService = $stringService;
        $this->fileCreator = $fileCreator;
        $this->module = $module;
        $this->codeTest = $codeTest;

        return $this;
    }


    public function createTest(Src $src)
    {
        $this->src = $src;

        $this->getFileCreator()->createFile(
            'template/module/mvc/value-object/test-src.phtml',
            array(
                'var' => $this->str('var', $this->src->getName()),
                'class'   => $this->src->getName(),
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
                'module'  => $this->getModule()->getModuleName()
            ),
            $this->src->getName().'Test.php',
            $this->getCodeTest()->getLocation($this->src)
        );
    }
}
