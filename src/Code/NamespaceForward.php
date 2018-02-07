<?php
namespace Gear\Code;

use Exception;

class NamespaceForward
{
    private $workspace = null;

    const FORMAT = [
        'prophesize' => '/\$this->prophesize\((\'([A-Za-z0-9\\\\***REMOVED****)\')\)/',
        'instance' => '/new \\\\([A-Za-z\\\\***REMOVED****)/',
    ***REMOVED***;

    const USE = 'use %s;';

    const CLASS_CALL = '%s::class';


    public function extractClassName($name)
    {
        $names = explode('\\', $name);
        return $names[count($names)-1***REMOVED***;
    }


    public function replaceText($search, $replace)
    {
        $this->workspace = str_replace(
            $search,
            $replace,
            $this->workspace
        );
    }


    public function format($file)
    {
        $this->workspace = $file;
        $this->use = [***REMOVED***;

        $matches = [***REMOVED***;
        preg_match_all(self::FORMAT['prophesize'***REMOVED***, $this->workspace, $matches);
        foreach ($matches[2***REMOVED*** as $key => $classFullname) {

            $this->replaceText(
                $matches[1***REMOVED***[$key***REMOVED***,
                sprintf(self::CLASS_CALL, $this->extractClassName($classFullname))
            );

            $this->use[***REMOVED*** = sprintf(self::USE, $classFullname);
        }

        $matches = [***REMOVED***;
        preg_match_all(self::FORMAT['instance'***REMOVED***, $this->workspace, $matches);

        foreach ($matches[1***REMOVED*** as $key => $classFullname) {

            $this->replaceText(
                '\\'.$matches[1***REMOVED***[$key***REMOVED***,
                $this->extractClassName($classFullname)
            );

            $this->use[***REMOVED*** = sprintf(self::USE, $classFullname);
        }


        return [
            'use' => $this->use,
            'code' => $this->workspace,
        ***REMOVED***;
    }
}
