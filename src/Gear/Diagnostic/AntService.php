<?php
namespace Gear\Diagnostic;

use Gear\Service\AbstractJsonService;

/**
 * Executar as verificações/diagnósticos para módulos e projetos no arquivo build.xml.
 */
class AntService extends AbstractJsonService implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    public $errors;

    public function __construct($module, $stringService)
    {
        $this->errors = [***REMOVED***;
        $this->module = $module;
        $this->stringService = $stringService;
    }


    public function modulesTarget()
    {
        return [
            ['clean', ''***REMOVED***,
            ['prepare', 'clean'***REMOVED***,
            ['set-vendor', 'isRunningAsModule, isRunningAsVendor, isRunningAsProject'***REMOVED***,
            ['isRunningAsModule', 'check.runningAsModule'***REMOVED***,
            ['isRunningAsVendor', 'check.runningAsVendor'***REMOVED***,
            ['isRunningAsProject', 'check.runningAsProject'***REMOVED***,
            ['check.runningAsModule', ''***REMOVED***,
            ['check.runningAsVendor', ''***REMOVED***,
            ['check.runningAsProject', ''***REMOVED***,
            ['phpcs', 'set-vendor'***REMOVED***,
            ['phpcs-ci', 'set-vendor'***REMOVED***,
            ['phpmd', 'set-vendor'***REMOVED***,
            ['phpmd-ci', 'set-vendor'***REMOVED***,
            ['phpcpd', 'set-vendor'***REMOVED***,
            ['parallel-lint', 'set-vendor'***REMOVED***,
            ['phpdox', ''***REMOVED***,
            ['db-load', ''***REMOVED***,
            ['cache-load', ''***REMOVED***,
            ['phploc-ci', 'set-vendor'***REMOVED***,
            ['buildHelper', ''***REMOVED***,
            ['publish', ''***REMOVED***,
        ***REMOVED***;
    }

    /**
     * Rodar diagnóstico da build.xml para Módulo
     */
    public function diagnosticModuleWeb()
    {
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

        foreach ($this->modulesTarget() as $data) {
            $this->checkTarget($data[0***REMOVED***, $data[1***REMOVED***);
        }

        return $this->errors;
    }

    public function diagnosticModuleCli()
    {

        return [***REMOVED***;
    }

    public function diagnosticProjectWeb()
    {
        return [***REMOVED***;
    }


    /**
     * Verifica se um determinado target existe no arquivo build, se não existe incrementa os erros.
     */
    public function checkTarget($targetName, $depend = '')
    {
        if (!$this->hasTarget($targetName)) {
            $this->errors[***REMOVED*** = sprintf('Está faltando o Target %s no arquivo build.xml', $targetName);
            return;
        }

        if (!$this->hasDepend($targetName, $depend)) {
            $this->errors[***REMOVED*** = sprintf('Corrigir depends do Target %s para no arquivo build.xml', $targetName);
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
        if ((string) $this->build->attributes()->name === $this->getStringService()->str('url', $this->module->getModuleName())) {
            return true;
        }

        return false;
    }
}

