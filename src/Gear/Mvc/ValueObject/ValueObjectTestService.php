<?php
namespace Gear\Mvc\ValueObject;

use Gear\Module\ModuleAwareInterface;
use GearBase\Util\String\StringServiceTrait;
use Gear\Creator\FileCreatorTrait;
use Gear\Module\ModuleAwareTrait;
use GearBase\Util\String\StringService;
use Gear\Creator\File;
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
        BasicModuleStructure $module
    ) {
        $this->stringService = $stringService;
        $this->fileCreator = $fileCreator;
        $this->module = $module;

        return $this;
    }


    public function createTest(Src $src)
    {
        $this->getFileCreator()->createFile(
            'template/module/mvc/value-object/test-src.phtml',
            array(
                'serviceNameUline' => $this->str('var', $src->getName()),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestValueObjectFolder()
        );
    }
}
