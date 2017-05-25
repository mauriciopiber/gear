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

    public function setParams(array $params)
    {
        $this->params = $params;
    }


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


    public function createParams($params)
    {
        $data = [***REMOVED***;
        foreach ($params as $classDependency) {
            $var = $classDependency;

            preg_match_all('/((?:^|[A-Z***REMOVED***)[a-z***REMOVED***+)/', $var, $matches);

            $data[***REMOVED*** = $matches[0***REMOVED***;
        }

        $this->params = [***REMOVED***;

        foreach ($data as $index => $param) {
            $count = $this->sumParamValue($param);

            if ($count <= 20) {
                $this->params[$index***REMOVED*** = $this->addParam($param);
                unset($data[$index***REMOVED***);
                continue;
            }
        }

        if (empty($data)) {
            return $this->params;
        }


        return $this->determineParams($data);
    }

    /**
     * Return the KEYS that will be removed to cut param, on a DESC order.
     */
    public function revertIntersect($intersect)
    {
        $keys = array_keys($intersect);
        $rValues = array_reverse($keys);

        return $rValues;
    }

    /**
     * Return the KEYS that will be removed to cut param, on a ASC order.
     */
    public function forwardIntersect($intersect)
    {

        return array_keys($intersect);
    }

    public function determineParams($data)
    {
        $intersect = $this->intersectParamsValues($data);


        foreach ($data as $index => $value) {
            foreach ($this->forwardIntersect($intersect) as $removeKey) {
                unset($value[$removeKey***REMOVED***);

                $count = $this->sumParamValue($value);

                if ($count <= 20) {
                    $candidate = $this->addParam($value);
                    if (!in_array($candidate, $this->params)) {
                        $this->params[$index***REMOVED*** = $candidate;
                        unset($data[$index***REMOVED***);
                        break;
                    }
                }
            }
        }

        if (empty($data)) {
            return $this->params;
        }


        foreach ($data as $index => $value) {
            foreach ($this->revertIntersect($intersect) as $removeKey) {
                unset($value[$removeKey***REMOVED***);

                $count = $this->sumParamValue($value);

                if ($count <= 20) {
                    $candidate = $this->addParam($value);
                    if (!in_array($candidate, $this->params)) {
                        $this->params[$index***REMOVED*** = $candidate;
                        unset($data[$index***REMOVED***);
                        break;
                    }
                }
            }
        }

        if (empty($data)) {
            return $this->params;
            ;
        }

        throw new \Exception('Params errors');
    }


    public function addParam($param)
    {
        return $this->str('var', implode('', $param));
    }

    public function sumParamValue($data)
    {
        $test = array_map(function ($value) {
            return strlen($value);
        }, $data);

        return array_sum($test);
    }

    public function intersectParamsValues($data)
    {
        $intersect = [***REMOVED***;

        foreach ($data as $index => $params) {
            if (empty($intersect)) {
                $intersect = $params;
                continue;
            }

            $intersect = array_intersect($intersect, $params);
        }
        return $intersect;
    }
}
