<?php
namespace Gear\Creator\Component\Constructor;

use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringService;
use Gear\Creator\Component\Constructor\Exception\ParamsConflitException;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Creator/Component/Constructor
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ConstructorParams
{
    use StringServiceTrait;

    const LIMIT_PARAM_SIZE = 20;

    /**
     * Constructor
     *
     * @param StringService $stringService String Service
     *
     * @return \Gear\Creator\Component\Constructor\ConstructorParams
     */
    public function __construct(StringService $stringService)
    {
        $this->stringService = $stringService;

        return $this;
    }


    public function cutVars(&$paramsStack)
    {
        $historyStep = [***REMOVED***;
        $addNames = [***REMOVED***;
        $issueStep = [***REMOVED***;

        //$index is the PARAM index.
        //$i is the POSITION index.
        foreach ($paramsStack as $index => $names) {

            if (!isset($issueStep[$index***REMOVED***)) {
                $issueStep[$index***REMOVED*** = [***REMOVED***;
            }

            foreach ($names as $i => $name) {

                if (!isset($historyStep[$i***REMOVED***)) {
                    $historyStep[$i***REMOVED*** = [***REMOVED***;

                    if ($index == 0) {
                        $historyStep[$i***REMOVED***[***REMOVED*** = $name;
                    }
                }

                if (in_array($name, $historyStep[$i***REMOVED***)) {
                    $issueStep[$index***REMOVED***[***REMOVED*** = $i;
                } else {
                    $historyStep[$i***REMOVED***[***REMOVED*** = $name;
                }
            }
        }


        $all = 0;

        foreach ($issueStep as $step) {
            $all += count($step);
        }

        if ($all <= 0) {
            return;
        }

        $greaterIndex = null;
        $max = 0;

        foreach ($historyStep as $index => $history) {
            if (count($history) > $max) {
                $greaterIndex = $index;
                $max = count($history);
            }
        }

        $move = null;

        if ($greaterIndex === 0) {
            $move = true;
        } else {
            $final = ($greaterIndex)/count($historyStep);
            $move = ($final <= 0.5) ? true : false;
        }

        //executa os iterates.
        $tempParams = $paramsStack;

        foreach ($tempParams as $index => $names) {

            $tempParams[$index***REMOVED*** = array_values($this->iterateRemoveNames($names, $issueStep[$index***REMOVED***, $move));
        }

        $paramsStack = $tempParams;
    }


    public function iterateRemoveNames(array $names, array $toRemove, $move = true)
    {
        $size = implode('', $names);

        //se o tamanho de todo names for menor que o limite, pode retornar.
        if (strlen($size) <= self::LIMIT_PARAM_SIZE) {
            return $names;
        }

        //se for forward, deve ir para a primeira duplicidade e remover.
        //se for backward, deve ir para a última duplicidade e remover.

        //fix
        if ($move === true) {
            end($toRemove);
        } else {
            reset($toRemove);
        }

        if (empty($toRemove)) {
            $this->removeName($names, 0);
            $names = array_values($names);
        } else {
            $toRemoveKey = key($toRemove);
            $this->removeName($names, $toRemoveKey);
            unset($toRemove[$toRemoveKey***REMOVED***);
            $toRemove = array_values($toRemove);
        }
        return $this->iterateRemoveNames($names, $toRemove, $move);
    }

    public function removeName(&$names, $toRemoveKey)
    {
        unset($names[$toRemoveKey***REMOVED***); //deleta a chave esperada.
    }

    public function tokenizeParams($paramsStack)
    {
        $history = [***REMOVED***;
        $names = [***REMOVED***;

        $this->cutVars($paramsStack);

        foreach ($paramsStack as $index => $nameArray) {
            $names[***REMOVED*** = $this->str('var', implode('', $nameArray));
        }

        if (count($names) !== count(array_unique($names))) {
            throw new ParamsConflitException(var_export($names, true));
        }
        return $names;
    }

}
