<?php
namespace Gear\Integration\Util\ResolveNames;

use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringService;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;

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

    public function createTableName($superType, MvcMinorSuite $suite)
    {
        return sprintf(
            '%s%s',
            'Mvc',
            implode('', $this->createTableAliase($suite))
        );
    }

    public function createLocationKey($mvcMajor, MvcMinorSuite $suite)
    {
        $key = sprintf(
            '%s/mvc-%s',
            $this->stringService->str('url', $mvcMajor),
            implode('-', $this->createTableUrl($suite))
        );

        return $key;

    }

    private function createAliase(MvcMinorSuite $suite)
    {
        $variables = [***REMOVED***;
        $variables[***REMOVED*** = $this->getColumnsType($suite->getColumnType());

        if ($suite->getUserType() != 'all') {
            $variables[***REMOVED*** = $suite->getUserType();
        }

        $variables = array_merge($variables, $this->getConstraintLabel($suite->getConstraints()));

        if ($suite->getTableAssoc() !== null) {
            $variables[***REMOVED*** = $suite->getTableAssoc();
        }
        return $variables;
    }

    private function format(MvcMinorSuite $suite, $stringType)
    {
        $variables = $this->createAliase($suite);

        foreach ($variables as $i => $name) {
            $variables[$i***REMOVED*** = $this->stringService->str($stringType, $name);
        }

        return $variables;
    }

    public function createTableUrl(MvcMinorSuite $suite)
    {
        return $this->format($suite, 'url');
    }

    public function createTableAliase(MvcMinorSuite $suite)
    {
        return $this->format($suite, 'class');
    }
}
