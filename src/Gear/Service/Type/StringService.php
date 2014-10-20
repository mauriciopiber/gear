<?php
namespace Gear\Service\Type;

use Gear\Service\AbstractService;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class StringService extends AbstractService
{

    public function str($type = null, $data = null)
    {
        return $this->strBuilder($type, $data);
    }

    public function strBuilder($type, $data)
    {
        if (empty($type) && !is_string($data)) {
            return false;
        }

        switch ($type) {
            case 'var':
                $function = 'baseToVar';
                break;
            case 'url':
                $function = 'baseToUrl';
                break;
            case 'code':
                $function = 'baseToCode';
                break;
            case 'class':
                $function = 'baseToClass';
                break;
            case 'label':
                $function = 'basetoLabel';
                break;
            case 'uline':
                $function = 'baseToUnderline';
                break;
            default:
                break;
        }
        $plus = 0;
        $format = '';
        $pieces = explode('_', $data);
        //caso tenha underline, ele olha pedaço por pedado atras de Maiúsculas.
        if (count($pieces)>1) {
            foreach ($pieces as $i => $v) {
                preg_match_all('/[A-Z***REMOVED***/', $v, $match, PREG_OFFSET_CAPTURE);
                if (count($match[0***REMOVED***)>0) {
                    foreach ($match[0***REMOVED*** as $a => $b) {
                        if (isset($match[0***REMOVED***[($a+1)***REMOVED***)) {
                            $last = $match[0***REMOVED***[($a+1)***REMOVED***[1***REMOVED***;
                        } else {
                            $last = strlen($v);
                        }
                        $format .= $this->$function(substr($v, $b[1***REMOVED***, $last-$b[1***REMOVED***), array($a, $i));
                    }
                } else {
                    $format .= $this->$function($v, array($i));
                }
            }
            //caso não tenha underline, ele olha pedaço por pedaço atras das Maiusculas
        } else {
            if (lcfirst($pieces[0***REMOVED***) == $pieces[0***REMOVED***) {
                preg_match('/[A-Z***REMOVED***/', $pieces[0***REMOVED***, $match, PREG_OFFSET_CAPTURE);
                if (isset($match[0***REMOVED***[1***REMOVED***)) {
                    $format .= $this->$function(substr($pieces[0***REMOVED***, 0, $match[0***REMOVED***[1***REMOVED***), array());
                    $plus = 1;
                }
            }
            preg_match_all('/[A-Z***REMOVED***/', $pieces[0***REMOVED***, $match, PREG_OFFSET_CAPTURE);
            if (count($match[0***REMOVED***)>0) {
                foreach ($match[0***REMOVED*** as $a => $b) {
                    if (isset($match[0***REMOVED***[($a+1)***REMOVED***)) {
                        $last = $match[0***REMOVED***[($a+1)***REMOVED***[1***REMOVED***;
                    } else {
                        $last = strlen($pieces[0***REMOVED***);
                    }
                    $format .= $this->$function(substr($pieces[0***REMOVED***, $b[1***REMOVED***, $last-$b[1***REMOVED***), array($a+$plus));
                }
            } else {
                $format .= $this->$function($pieces[0***REMOVED***,array($plus));
            }
        }

        return $format;

    }

    /**
     * Função responsável por dizer se estamos falando da primeira interação,
     * ou das subsequêntes, há algumas funções que alterar o valor da primeira letra da palavra.
     * @param  array   $iterator
     * @return boolean $beFirst retorna se é o primeiro elemento ou subsequêntes.
     */
    public function checkIterator($iterator = array())
    {
        $beFirst = true;
        foreach ($iterator as $v) {
            if ($v!=0) {
                $beFirst = false;
                break;
            }
        }

        return $beFirst;
    }

    public function baseToClass($eval)
    {
        return ucfirst($eval);
    }

    public function baseToVar($eval, $iterator = array())
    {
        return ($this->checkIterator($iterator)) ? lcfirst($eval) : ucfirst($eval);
    }

    public function baseToUrl($eval, $iterator = array())
    {
        return ($this->checkIterator($iterator)) ? strtolower($eval) : '-'.strtolower($eval);
    }
    public function baseToCode($eval)
    {
        return strtolower($eval);
    }
    public function baseToLabel($eval, $iterator = array())
    {
        if ($eval=='id' || $eval=='Id') {
            return '';
        }

        return ($this->checkIterator($iterator)) ? ucfirst($eval) : ' '.ucfirst($eval);
    }

    public function baseToUnderline($eval, $iterator = array())
    {
        return ($this->checkIterator($iterator)) ? strtolower($eval) : '_'.strtolower($eval);
    }
}
