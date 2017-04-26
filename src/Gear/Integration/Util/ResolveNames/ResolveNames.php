<?php
namespace Gear\Integration\Util\ResolveNames;

use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringService;
use Gear\Integration\Suite\AbstractMinorSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Util/ResolveNames
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ResolveNames
{
    use StringServiceTrait;

    /**
     * Constructor
     *
     * @param StringService $stringService
     *            String Service
     *
     * @return \Gear\Integration\Util\ResolveNames\ResolveNames
     */
    public function __construct(StringService $stringService)
    {
        $this->stringService = $stringService;

        return $this;
    }

    private function getConstraintLabel($constraint)
    {
        if ($constraint === null) {
            return [***REMOVED***;
        }

        if (is_array($constraint)) {
            return $constraint;
        }

        return [
            $constraint
        ***REMOVED***;
    }


    public function getColumnsType($type)
    {
        return $this->stringService->str('class', str_replace('mvc-', '', $type));
    }

    public function createTableName(AbstractMinorSuite $suite)
    {

    }

    public function createLocationKey(AbstractMinorSuite $suite)
    {

    }

    private function createAliase($type, $usertype, $constraint, $tables)
    {
        $variables = [***REMOVED***;
        $variables[***REMOVED*** = $this->getColumnsType($type);

        if ($usertype != 'all') {
            $variables[***REMOVED*** = $usertype;
        }

        $variables = array_merge($variables, $this->getConstraintLabel($constraint));

        if ($tables !== null) {
            $variables[***REMOVED*** = $tables;
        }
        return $variables;
    }

    private function format($type, $usertype, $constraint, $tables, $stringType)
    {
        $variables = $this->createAliase($type, $usertype, $constraint, $tables);

        foreach ($variables as $i => $name) {
            $variables[$i***REMOVED*** = $this->stringService->str($stringType, $name);
        }

        return $variables;
    }

    public function createTableUrl($type, $usertype, $constraint, $tables)
    {
        return $this->format($type, $usertype, $constraint, $tables, 'url');
    }

    public function createTableAliase($type, $usertype, $constraint, $tables)
    {
        return $this->format($type, $usertype, $constraint, $tables, 'class');
    }
}
