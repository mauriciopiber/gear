<?php
namespace Gear\Integration\Suite\Mvc;

use Gear\Integration\Util\Names\NamesReplaceInterface;

trait UtilNameTrait
{
    protected $tableName;

    protected $tableAlias;

    protected $locationKey;

    public function getTableAlias()
    {
        if (isset($this->tableAlias) && !empty($this->tableAlias)) {
            return $this->tableAlias;
        }

        $tableKey = $this->format('class', true);

        $suiteName = ($this->getMajorSuite()->getSuite() == 'controller-mvc')
            ? 'SrcMvc'
            : $this->getMajorSuite()->getSuite();

        $this->tableAlias = sprintf(
            '%s%s',
            $this->stringService->str('class', $suiteName),
            implode('', $tableKey)
        );

        return $this->tableAlias;
    }

    public function getTableName()
    {
        if (isset($this->tableName) && !empty($this->tableName)) {
            return $this->tableName;
        }

        $tableKey = $this->format('class', false);

        $suiteName = ($this->getMajorSuite()->getSuite() == 'controller-mvc')
            ? 'SrcMvc'
            : $this->getMajorSuite()->getSuite();

        $this->tableName = sprintf(
            '%s%s',
            $this->stringService->str('class', $suiteName),
            implode('', $tableKey)
        );

        return $this->tableName;
    }

    public function getLocationKey()
    {
        if (isset($this->locationKey) && !empty($this->locationKey)) {
            return $this->locationKey;
        }
        $tableUrl = $this->format('url', false);

        $this->locationKey = sprintf(
            'mvc/%s/mvc-%s',
            $this->stringService->str('url', $this->getMajorSuite()->getSuperType()),
            implode('-', $tableUrl)
        );

        return $this->locationKey;
    }

    private function format($stringType, $minify)
    {
        $variables = $this->createAliase($stringType);

        if ($minify === true) {
            $variables = $this->cutVars($variables);
        }

        foreach ($variables as $i => $name) {
            if (is_array($name)) {
                $name = implode('-', $name);
            }

            $variables[$i***REMOVED*** = $this->stringService->str($stringType, $name);
        }

        return $variables;
    }


    /**
     * Create Array of Values to Convert to Table Name
     *
     * @param MvcMinorSuite $suite
     *
     * @return array
     */
    private function createAliase()
    {
        $variables = [***REMOVED***;

        //column Type
        $variables[***REMOVED*** = $this->getColumnType();

        //user Type
        if ($this->getUserType() != 'all') {
            $variables[***REMOVED*** = $this->getUserType();
        }

        //constraint Type
        $variables = array_merge($variables, $this->getConstraintLabel($this->getConstraints()));

        //table assoc
        if ($this->getTableAssoc() !== null) {
            $variables[***REMOVED*** = $this->getTableAssoc();
        }
        return $variables;
    }


    private function cutVars($variables)
    {
        if ($this->isUsingLongName() === true) {
            return $variables;
        }

        return $this->cutNames($variables);
    }

    private function cutNames(array $variables)
    {
        $label = NamesReplaceInterface::NAMES;

        $text = [***REMOVED***;

        foreach ($variables as $option) {
            $text[***REMOVED*** = $label[$this->stringService->str('url', $option)***REMOVED***;
        }

        //var_dump($text);
        return $text;
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
}

