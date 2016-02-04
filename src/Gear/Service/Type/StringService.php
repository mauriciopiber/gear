<?php
namespace Gear\Service\Type;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class StringService implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function str($type = null, $data = null)
    {
        return $this->strBuilder($type, $data);
    }



    public function getPieces($data)
    {

        $explodeUnderline = explode('_', $data);

        if (count($explodeUnderline) > 1) {
            return $explodeUnderline;
        }

        $explodeHiffen = explode('-', $data);

        if (count($explodeHiffen) > 1) {
            return $explodeHiffen;
        }

        return $explodeUnderline;
        /*
        if (strpos($data, '_') !== false) {

        }

        if (strpos($data, '-') !== false) {
            return explode('-', $data);
        }

        return $data;
        */
    }

    public function typeToFunction($type)
    {
        switch ($type) {
            case 'var':
                $this->function = 'baseToVar';
                break;
            case 'url':
                $this->function = 'baseToUrl';
                break;
            case 'code':
                $this->function = 'baseToCode';
                break;
            case 'class':
                $this->function = 'baseToClass';
                break;
            case 'label':
                $this->function = 'basetoLabel';
                break;
            case 'uline':
                $this->function = 'baseToUnderline';
                break;
            case 'hifen':
                $this->function = 'baseToHifen';
                break;
            case 'point':
                $this->function = 'baseToPoint';
                break;
            case 'var-lenght':
                $this->function = 'baseToVarLenght';
                break;
            case 'class-lenght':
                $this->function = 'baseToClassLenght';
                break;
            default:
                break;
        }
    }

    public function strBuilder($type, $data)
    {
        if (empty($type) && !is_string($data)) {
            return false;
        }

        $this->typeToFunction($type);
        $this->plus = 0;
        $this->format = '';
        $this->pieces = $this->getPieces($data);
        //caso tenha underline, ele olha pedaço por pedado atras de Maiúsculas.
        if (count($this->pieces)>1) {
            $this->processUnderline();
            //caso não tenha underline, ele olha pedaço por pedaço atras das Maiusculas
        } else {
            $this->process();
        }
        return $this->format;
    }

    public function processUnderline()
    {
        foreach ($this->pieces as $i => $v) {
            preg_match_all('/[A-Z***REMOVED***/', $v, $match, PREG_OFFSET_CAPTURE);
            if (count($match[0***REMOVED***)>0) {
                foreach ($match[0***REMOVED*** as $a => $b) {
                    if (isset($match[0***REMOVED***[($a+1)***REMOVED***)) {
                        $last = $match[0***REMOVED***[($a+1)***REMOVED***[1***REMOVED***;
                    } else {
                        $last = strlen($v);
                    }
                    $this->format .= $this->{$this->function}(substr($v, $b[1***REMOVED***, $last-$b[1***REMOVED***), array($a, $i));
                }
            } else {
                $this->format .= $this->{$this->function}($v, array($i));
            }
            $this->format = trim($this->format);
        }
    }
    /**
     * Procura por palavras iniciadas por maiuscula e converte para o padrão desejado.
     */
    public function process()
    {
        if (lcfirst($this->pieces[0***REMOVED***) == $this->pieces[0***REMOVED***) {
            preg_match('/[A-Z***REMOVED***/', $this->pieces[0***REMOVED***, $match, PREG_OFFSET_CAPTURE);
            if (isset($match[0***REMOVED***[1***REMOVED***)) {
                $this->format .= $this->{$this->function}(substr($this->pieces[0***REMOVED***, 0, $match[0***REMOVED***[1***REMOVED***), array());
                $this->plus = 1;
            }
        }
        preg_match_all('/[A-Z***REMOVED***/', $this->pieces[0***REMOVED***, $match, PREG_OFFSET_CAPTURE);
        if (count($match[0***REMOVED***)>0) {
            foreach ($match[0***REMOVED*** as $a => $b) {
                if (isset($match[0***REMOVED***[($a+1)***REMOVED***)) {
                    $last = $match[0***REMOVED***[($a+1)***REMOVED***[1***REMOVED***;
                } else {
                    $last = strlen($this->pieces[0***REMOVED***);
                }
                $this->format .= $this->{$this->function}(substr($this->pieces[0***REMOVED***, $b[1***REMOVED***, $last-$b[1***REMOVED***), array($a+$this->plus));
            }
        } else {
            $this->format .= $this->{$this->function}($this->pieces[0***REMOVED***,array($this->plus));
        }
        $this->format = trim($this->format);
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

    public function baseToClassLenght($eval)
    {
        if (strlen($this->format.$eval) > 20) {
            return '';
        }
        return ucfirst($eval);
    }

    public function baseToVarLenght($eval, $iterator = array())
    {
        if (strlen($this->format.$eval) > 20) {
            return '';
        }
        return ($this->checkIterator($iterator)) ? lcfirst($eval) : ucfirst($eval);
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
        $eval = str_replace('-', '', $eval);
        return ($this->checkIterator($iterator)) ? strtolower($eval) : '-'.strtolower($eval);
    }

    public function baseToPoint($eval, $iterator = array())
    {
        return ($this->checkIterator($iterator)) ? strtolower($eval) : '.'.strtolower($eval);
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
