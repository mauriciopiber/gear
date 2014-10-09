<?php
namespace Gear\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ArrayToYml extends AbstractHelper
{
    public function __invoke($options)
    {
        if (count($options) <= 0) {
            return '[***REMOVED***';
        }

        $yml = '[';

        foreach ($options as $i => $v) {
            $yml .= $v;
            if (isset($options[$i+1***REMOVED***)) {
                $yml .= ', ';
            }
        }

        $yml .= '***REMOVED***';

        return $yml.PHP_EOL;
    }
}
