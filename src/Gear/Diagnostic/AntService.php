<?php
namespace Gear\Diagnostic;

use Gear\Service\AbstractJsonService;

/**
 * Executar as verificações/diagnósticos para módulos e projetos no arquivo build.xml.
 */
class AntService extends AbstractJsonService
{
    public $errors;

    public function __construct($module, $stringService)
    {
        $this->errors = [***REMOVED***;
        $this->module = $module;
        $this->stringService = $stringService;
    }

    /**
     * Rodar diagnóstico da build.xml para Módulo
     */
    public function diagnosticModule()
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



        $this->checkTarget('clean');
        $this->checkTarget('prepare');

        //set-vendor
        $this->checkTarget('set-vendor');
        $this->checkTarget('isRunningAsModule');
        $this->checkTarget('isRunningAsVendor');
        $this->checkTarget('isRunningAsProject');
        $this->checkTarget('check.runningAsModule');
        $this->checkTarget('check.runningAsVendor');
        $this->checkTarget('check.runningAsProject');



        $this->checkTarget('phpcs');
        $this->checkTarget('phpcs-ci');
        $this->checkTarget('phpmd');
        $this->checkTarget('phpmd-ci');
        $this->checkTarget('phpcpd');

        $this->checkTarget('parallel-lint');

        $this->checktarget('phpdox');


        $this->checktarget('db-load');

        $this->checktarget('cache-load');

        $this->checktarget('phploc-ci');

        $this->checkTarget('buildHelper');




        $this->checkTarget('publish');



        return $this->errors;
    }


    /**
     * Verifica se um determinado target existe no arquivo build, se não existe incrementa os erros.
     */
    public function checkTarget($targetName)
    {
        if (!$this->hasTarget($targetName)) {
            $this->errors[***REMOVED*** = sprintf('Está faltando o Target %s no arquivo build.xml', $targetName);
        }
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

