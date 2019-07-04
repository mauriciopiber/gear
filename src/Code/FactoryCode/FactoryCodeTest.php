<?php
namespace Gear\Code\FactoryCode;

use Gear\Code\AbstractCodeTest;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;
use Gear\Util\Dir\DirService;
use Gear\Util\Dir\DirServiceTrait;
use Gear\Util\Vector\ArrayService;
use Gear\Util\Vector\ArrayServiceTrait;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Creator/Codes/CodeTest/FactoryCode
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class FactoryCodeTest extends AbstractCodeTest
{
    use StringServiceTrait;

    use DirServiceTrait;

    use ModuleStructureTrait;

    use ArrayServiceTrait;

    public function __construct(
        ModuleStructure $module,
        StringService $string,
        DirService $dir,
        ArrayService $arrayService
    ) {
        $this->setStringService($string);
        $this->setModule($module);
        $this->setDirService($dir);
        $this->setArrayService($arrayService);
    }


    const TEMPLATE_ALIASE = <<<EOS
        \$this->container->get('%s')
            ->willReturn(\$this->prophesize(%s::class)->reveal())
            ->shouldBeCalled();
EOS;

    const TEMPLATE_CLASS = <<<EOS
        \$this->container->get(%s::class)
            ->willReturn(\$this->prophesize(%s::class)->reveal())
            ->shouldBeCalled();
EOS;


    private function extractServiceManagerFromDependency($dependency, $i)
    {
        if (is_string($i) && strlen($i) > 0) {
            return $i;
        }

        if (is_array($dependency) && isset($dependency['aliase'***REMOVED***)) {
            return $dependency['aliase'***REMOVED***;
        }

        if (is_array($dependency) && isset($dependency['class'***REMOVED***)) {
            return $this->resolveName($dependency['class'***REMOVED***);
        }

        return $this->resolveName($dependency);
    }

    public function getServiceManagerDependencies($src)
    {
        if (empty($src->getDependency())) {
            return '';
        }

        $msg = PHP_EOL;

        $values = array_map("unserialize", array_unique(array_map("serialize", $src->getDependency())));

        $alldep = count($values);

        foreach ($values as $i => $dependency) {
            $alldep -= 1;

            $fullname = $this->resolveName($dependency);
            $variable = $this->extractServiceManagerFromDependency($dependency, $i);

            $template = (isset($dependency['aliase'***REMOVED***) || is_string($i))
                ? self::TEMPLATE_ALIASE
                : self::TEMPLATE_CLASS;


            $msg .= sprintf($template, $variable, $fullname);
            $msg .= PHP_EOL;
            if (is_integer($i) && isset($src->getDependency()[$i+1***REMOVED***) || $alldep > 0) {
                $msg .= PHP_EOL;
            }
        }

        return $msg;
    }

    public function getUse($data)
    {
        $this->uses = [***REMOVED***;

        if (($data->hasDependency()) && $data->isFactory()) {

            $values = array_map("unserialize", array_unique(array_map("serialize", $data->getDependency())));

            foreach ($values as $aliase => $item) {
                $this->uses[***REMOVED*** = $this->resolveNamespace($item);
            }
        }
        return $this->printUse($this->uses);
    }
}
