<?php
namespace Gear\Constructor\Helper;

class ExtractFromClass
{
    public static function getFunctionsName($file, $str)
    {
        $actions = [***REMOVED***;
        preg_match_all('/public function [a-zA-Z()***REMOVED****/', $file, $matches);

        if (!empty($matches)) {
            foreach ($matches[0***REMOVED*** as $match) {
                $actionName = str_replace('public function ', '', $match);
                $actionName = str_replace('Action()', '', $actionName);
                $actionName = str_replace('Action(', '', $actionName);
                $actionName = str_replace('()', '', $actionName);
                $actionName = str_replace('(', '', $actionName);
                $actionName = trim($actionName);
                $actionName = $str->str('class', $actionName);
                $actions[***REMOVED***  = $actionName;
            }
        }

        return $actions;
    }
}
