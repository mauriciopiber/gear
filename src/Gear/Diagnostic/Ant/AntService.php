<?php
namespace Gear\Diagnostic\Ant;

use Gear\Service\AbstractJsonService;
use Gear\Project\ProjectLocationTrait;
use Gear\Edge\AntEdge\AntEdgeTrait;

/**
 * Executar as verificações/diagnósticos para módulos e projetos no arquivo build.xml.
 */
class AntService extends AbstractJsonService //implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    public $errors;

    static protected $missingTarget = 'Está faltando target %s no arquivo build.xml';

    static protected $missingDepends = 'Corrigir depends do Target %s para no arquivo build.xml';

    use ProjectLocationTrait;

    use AntEdgeTrait;

    public function __construct($stringService, $module = null)
    {
        $this->errors = [***REMOVED***;
        $this->stringService = $stringService;
        $this->module = $module;
    }

    /**
     * Rodar diagnóstico da build.xml para Módulo
     */
    public function diagnosticModule($type)
    {
        $edge = $this->getAntEdge()->getAntModule($type);

        if (!isset($edge['target'***REMOVED***) || empty($edge['target'***REMOVED***)) {
            throw new \Gear\Edge\AntEdge\Exception\MissingTarget();
        }

        if (!isset($edge['default'***REMOVED***) || empty($edge['default'***REMOVED***)) {
            throw new \Gear\Edge\AntEdge\Exception\MissingDefault();
        }

        $build = $this->module->getMainFolder().'/build.xml';

        if (!is_file($build)) {
            $this->errors[***REMOVED*** = sprintf('Está faltando o arquivo %s', $build);
            return $this->errors;
        }

        $this->file = $this->module->getMainFolder().'/build.xml';

        $this->build = simplexml_load_file($this->file);


        if (!$this->hasName()) {
            $this->errors[***REMOVED*** = 'Está faltando o nome corretamente na build.xml';
        }




        foreach ($edge['target'***REMOVED*** as $target => $dependency) {

            $this->checkTarget($target, $dependency);
        }

        return $this->errors;
    }

    public function diagnosticProject($type)
    {
        return [***REMOVED***;
    }


    /**
     * Verifica se um determinado target existe no arquivo build, se não existe incrementa os erros.
     */
    public function checkTarget($targetName, $depend = '')
    {
        if (!$this->hasTarget($targetName)) {
            $this->errors[***REMOVED*** = sprintf(static::$missingTarget, $targetName);
            return;
        }

        if (!$this->hasDepend($targetName, $depend)) {
            $this->errors[***REMOVED*** = sprintf(static::$missingDepends, $targetName);
        }
    }

    /**
     * Verifica se o Target tem a dependência exigida corretamente.
     */
    public function hasDepend($targetName, $depend)
    {
        foreach ($this->build[0***REMOVED***->target as $target) {
            $name = (string) $target[0***REMOVED***->attributes()->name;

            if ($name === $targetName) {

                if ($depend === (string) $target[0***REMOVED***->attributes()->depends[0***REMOVED***) {
                    return true;
                }
                continue;
            }
        }

        return false;
    }


    /**
     * Verificar se há determinado Target no arquivo build.xml
     * @param string $search Nome do Target.
     * @return boolean
     */
    public function hasTarget($search)
    {
        foreach ($this->build[0***REMOVED***->target as $target) {
            $name = (string) $target[0***REMOVED***->attributes()->name;
            if ($name === $search) {
                return true;
            }
        }

        return false;
    }

    /**
     * Verificar se o nome está respeitando o nome do módulo
     * @return boolean
     */
    public function hasName()
    {
        if (
            (string) $this->build->attributes()->name
            === $this->getStringService()->str('url', $this->module->getModuleName())
        ) {
            return true;
        }

        return false;
    }
}
