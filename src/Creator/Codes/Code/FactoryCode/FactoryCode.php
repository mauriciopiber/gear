<?php
namespace Gear\Creator\Codes\Code\FactoryCode;

use Gear\Creator\Codes\Code\AbstractCode;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Creator/Codes/Code/FactoryCode
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class FactoryCode extends AbstractCode
{
    const FACTORY_SERVICE_LOCATOR_STRING = '$container->get(\'%s\')';
    const FACTORY_SERVICE_LOCATOR_CLASS = '$container->get(%s::class)';

    /**
     * @TODO FIX
     */
    public function getServiceLocatorFactory($data)
    {
        if (empty($data->getDependency())) {
            return '';
        }

        $indent = str_repeat(' ', 4*3);

        $text = '';


        $iterator = 0;

        $values = array_map("unserialize", array_unique(array_map("serialize", $data->getDependency())));

        $allDeps = count($values);

        foreach ($values as $alias => $dependency) {
            $text .= $this->getDependencyCallable($indent, $alias, $dependency);

            if ($iterator < $allDeps-1) {
                $iterator += 1;
                $text .= ',';
            }
            $text .= PHP_EOL;
        }

        return $text;
    }


    public function getCustomTemplate($indent, $templateName)
    {
        $templates = [***REMOVED***;

        $templates['memcached'***REMOVED*** = <<<EOS
{$indent}(extension_loaded('memcached'))
{$indent}? \$container->get('memcached')
{$indent}: \$container->get('filesystem')
EOS;


        return $templates[$templateName***REMOVED***;
    }

    public function getDependencyCallable($indent, $alias, $dependency)
    {
        if (!is_int($alias) && in_array($alias, ['memcached'***REMOVED***)) {
            return $this->getCustomTemplate($indent, $alias);
        }

        if (is_string($alias) && strlen($alias) > 0) {
            return $indent.sprintf(self::FACTORY_SERVICE_LOCATOR_STRING, $alias);
        }

        if (is_array($dependency) && isset($dependency['aliase'***REMOVED***)) {
            return $indent.sprintf(self::FACTORY_SERVICE_LOCATOR_STRING, $dependency['aliase'***REMOVED***);
        }

        $name = $this->resolveName($dependency);
        return $indent.sprintf(self::FACTORY_SERVICE_LOCATOR_CLASS, $name);
    }

    public function getUse($data)
    {
        $this->uses = [***REMOVED***;

        if (($data->hasDependency()) && $data->isFactory()) {

            $values = array_map("unserialize", array_unique(array_map("serialize", $data->getDependency())));

            foreach ($values as $aliase => $item) {
                if (isset($item['aliase'***REMOVED***) || is_string($aliase)) {
                    continue;
                }

                $this->uses[***REMOVED*** = $this->resolveNamespace($item);
            }
        }

        return $this->printUse($this->uses);
    }
}
