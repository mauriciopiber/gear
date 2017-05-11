<?php
namespace Gear\Integration\Util\ResolveNames;

use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringService;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Util\Names\NamesReplaceInterface;

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

    /**
     * Resolve Constraint Label Names
     *
     * @param array|null $constraint
     *
     * @return array
     */
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

    /**
     * Get Column Type Name Used to Table Names
     *
     * @param string $type
     *
     * @return string
     */
    public function getColumnsType($type)
    {
        return $this->stringService->str('class', str_replace('mvc-', '', $type));
    }

    public function createTableName($superType, MvcMinorSuite $suite)
    {
        $tableName = sprintf(
            '%s%s',
            'Mvc',
            implode('', $this->createTableAliase($suite))
        );

        var_dump($tableName);
        return $tableName;
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

    /**
     * Create Array of Values to Convert to Table Name
     *
     * @param MvcMinorSuite $suite
     *
     * @return array
     */
    private function createAliase(MvcMinorSuite $suite)
    {
        $variables = [***REMOVED***;

        //column Type
        $variables[***REMOVED*** = $this->getColumnsType($suite->getColumnType());

        //user Type
        if ($suite->getUserType() != 'all') {
            $variables[***REMOVED*** = $suite->getUserType();
        }

        //constraint Type
        $variables = array_merge($variables, $this->getConstraintLabel($suite->getConstraints()));

        //table assoc
        if ($suite->getTableAssoc() !== null) {
            $variables[***REMOVED*** = $suite->getTableAssoc();
        }
        return $variables;
    }

    public function cutNames(array $variables)
    {
        $label = NamesReplaceInterface::NAMES;

        $text = [***REMOVED***;

        foreach ($variables as $option) {
            $text[***REMOVED*** = $label[$this->stringService->str('url', $option)***REMOVED***;
        }

        var_dump($text);
        return $text;
    }

    private function format(MvcMinorSuite $suite, $stringType, $minify = false)
    {
        $variables = $this->createAliase($suite);

        /*
        if ($minify) {
            $variables = $this->cutNames($variables);
        }
        */

        foreach ($variables as $i => $name) {

            if (is_array($name)) {
                $name = implode('-', $name);
            }

            $variables[$i***REMOVED*** = $this->stringService->str($stringType, $name);
        }

        return $variables;
    }

    public function createTableUrl(MvcMinorSuite $suite)
    {
        return $this->format($suite, 'url', false);
    }

    public function createTableAliase(MvcMinorSuite $suite)
    {
        return $this->format($suite, 'class', true);
    }
}
