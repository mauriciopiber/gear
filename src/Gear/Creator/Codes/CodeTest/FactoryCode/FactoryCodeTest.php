<?php
namespace Gear\Creator\Codes\CodeTest\FactoryCode;

use Gear\Creator\Codes\CodeTest\AbstractCodeTest;

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
    const TEMPLATE_ALIASE = <<<EOS
        \$this->serviceLocator->get('%s')
            ->willReturn(\$this->prophesize('%s')->reveal())
            ->shouldBeCalled();
EOS;

    const TEMPLATE_CLASS = <<<EOS
        \$this->serviceLocator->get(%s::class)
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
            return $this->resolveNamespace($dependency['class'***REMOVED***);
        }

        return $this->resolveNamespace($dependency);
    }

    public function getServiceManagerDependencies($src)
    {
        if (empty($src->getDependency())) {
            return '';
        }

        $msg = PHP_EOL;

        $alldep = count($src->getDependency());

        foreach ($src->getDependency() as $i => $dependency) {
            $alldep -= 1;

            $fullname = $this->resolveNamespace($dependency);
            $variable = $this->extractServiceManagerFromDependency($dependency, $i);

            $msg .= sprintf(self::TEMPLATE_ALIASE, $variable, $fullname);
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

        if (!empty($data->getDependency()) && $data->getService() === 'factories') {
            foreach ($data->getDependency() as $aliase => $item) {

                if (isset($item['aliase'***REMOVED***) || is_string($aliase)) {
                    continue;
                }

                $this->uses[***REMOVED*** = $this->resolveNamespace($item);
            }
        }
        return $this->printUse($this->uses);
    }
}
