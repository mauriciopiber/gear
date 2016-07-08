<?php
namespace Gear\Module\Config;

use Gear\Project\ProjectLocationTrait;
use Gear\Module\Config\Exception\MissingApplicationConfig;
use Gear\Module\BasicModuleStructure;
use Gear\Module\ModuleAwareTrait;
use GearBase\RequestTrait;

class ApplicationConfig
{
    use RequestTrait;

    use ModuleAwareTrait;

    use ProjectLocationTrait;

    public function __construct(BasicModuleStructure $module, $request)
    {
        $this->module = $module;
        $this->request = $request;
    }

    /**
     * Carrega do disco o arquivo de configuração do módulo
     *
     * @throws \Exception
     *
     * @return string
     */
    public function getApplicationConfig()
    {
        $module = $this->getProject().'/config/application.config.php';

        if (is_file($module)) {
            return $module;
        }

        throw new MissingApplicationConfig('Gear can\'t get application.config.php from project');
    }

    /**
     * Retorna o array de configurações de um módulo
     *
     * @return array
     */
    public function getApplicationConfigArray()
    {
        $applicationConfig = $this->getApplicationConfig();
        $data = include $applicationConfig;
        return $data;
    }

    /**
     * Função responsável por alterar o application.config.php e adicionar o novo módulo
     *
     * @return boolean
     */
    public function registerModule()
    {

        if (isset($this->before) && $this->before !== null) {
            return $this->registerBeforeModule();
        }

        if (isset($this->after) && $this->after !== null) {
            return $this->registerAfterModule();
        }



        $applicationConfig = $this->getApplicationConfig();

        $data = include $applicationConfig;

        $addValue = $this->getModule()->getModuleName();

        if (empty($addValue)) {
            throw new \Exception('Please inform us what module to register!');
        }

        if (($key = array_search($addValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $data['modules'***REMOVED***[***REMOVED*** = $addValue;

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        $dataArray = str_replace("'".$this->getProject().'/config/', "__DIR__.'/", $dataArray);

        file_put_contents($applicationConfig, '<?php return ' . $dataArray . '; ?>');

        //$this->getCacheService()->renewFileCache();

        return true;
    }

    /**
     * Função responsável por alterar o application.config.php e deletar o módulo escolhido
     *
     * @return boolean
     */
    public function unregisterModule()
    {
        $applicationConfig = $this->getApplicationConfig();

        $data = include $applicationConfig;

        $delValue = $this->getModule()->getModuleName();

        if (empty($delValue)) {
            throw new \Exception('Please inform us what module to unregister!');
        }

        if (($key = array_search($delValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents($applicationConfig, '<?php return ' . $dataArray . '; ?>');

        return true;
    }



    /**
     * Adiciona um módulo após a ocorrencia de um outro módulo, para manter a organização
     *
     * @return boolean
     */
    public function registerAfterModule()
    {
        $after = $this->after;

        $data = $this->getApplicationConfigArray();

        $addValue = $this->getModule()->getModuleName();

        if (($key = array_search($addValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $keyAfter = array_search($after, $data['modules'***REMOVED***);

        if ($keyAfter !== false) {
            $data['modules'***REMOVED*** = array_merge(
                array_slice($data['modules'***REMOVED***, 0, ($keyAfter+1)),
                array($addValue),
                array_slice($data['modules'***REMOVED***, ($keyAfter+1), null)
            );
        } else {
            $data['modules'***REMOVED***[***REMOVED*** = $addValue;
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        $dataArray = str_replace("'".$this->getProject().'/config/', "__DIR__.'/", $dataArray);


        file_put_contents($this->getApplicationConfig(), '<?php return ' . $dataArray . '; ?>');
        //$this->getCacheService()->renewFileCache();
        return true;
    }

    /**
     * Adiciona um módulo antes da ocorrencia de um outro módulo, para manter a organização
     *
     * @return boolean
     */
    public function registerBeforeModule()
    {
        $before = $this->before;

        $data = $this->getApplicationConfigArray();

        $addValue = $this->getModule()->getModuleName();

        if (($key = array_search($addValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $keyAfter = array_search($before, $data['modules'***REMOVED***);

        if ($keyAfter !== false) {
            $data['modules'***REMOVED*** = array_merge(
                array_slice($data['modules'***REMOVED***, 0, $keyAfter),
                array($addValue),
                array_slice($data['modules'***REMOVED***, $keyAfter, null)
            );
        } else {
            $data['modules'***REMOVED***[***REMOVED*** = $addValue;
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));
        $dataArray = str_replace("'".$this->getProject().'/config/', "__DIR__.'/", $dataArray);

        file_put_contents($this->getApplicationConfig(), '<?php return ' . $dataArray . '; ?>');
        //$this->getCacheService()->renewFileCache();
        return true;
    }


    /**
     * Carrega um módulo antes do outro
     *
     * @param array $data
     *
     * @return boolean
     */
    public function loadBefore($data)
    {
        $this->registerBeforeModule($data);
        return true;
    }

    /**
     * @ver 0.2.0 alias for registerModule
     *
     * @return boolean
     */
    public function load()
    {
        $this->after  = $this->getRequest()->getParam('after', null);
        $this->before = $this->getRequest()->getParam('before', null);

        $this->registerModule();
        return true;
    }

    /**
     * @ver 0.2.0 alias for unregisterModule
     *
     * @return boolean
     */
    public function unload()
    {
        $this->unregisterModule();
        return true;
    }
}
