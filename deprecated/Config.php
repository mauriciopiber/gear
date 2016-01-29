<?php
namespace Gear\ValueObject\Config;

/**
 *
 * @author piber
 *
 */
class Config
{

    protected $path;

    protected $module;

    protected $prefix;


    public function exist()
    {
        $file = $this->getPath().'/module/'.$this->getModule().'/src/'.$this->getModule().'/Module.php';
        if (is_file($file)) {
            return true;
        } else {
            return false;
        }
    }

    public function __construct($module)
    {
        $this->module = $module;
        $this->path = \Gear\Service\ProjectService::getProjectFolder();
    }

    /**
     * Caso venhas a alterar o local do arquivo, precisar modificar o caminho até a pasta $module
     * @return string
     */
    public function getLocal()
    {
        $moduleFolder = realpath(__DIR__."/../../../../../../");

        if (is_dir($moduleFolder.'/module')) {
            return $moduleFolder;
        }


        $moduleVendor = realpath(__DIR__."/../../../../../../../");

        if (is_dir($moduleVendor.'/module')) {
            return $moduleVendor;
        }

        throw new \Exception('Module folder can\'t be find on Config');
    }
    public function getModuleFolder()
    {
        return $this->getLocal().'/module/'.$this->getModule();
    }




/*
    public function getLocale()
    {
        return $this->locale;
    }

    public function getActionName($action = 'index')
    {
        $actionName = $action;

        $locale = $this->getLocale();

        switch ($action) {
            case 'index':
                $actionName = ($locale == 'pt_BR') ? 'index' : 'index';
            case 'add':
                $actionName = ($locale == 'pt_BR') ? 'adicionar' : 'add';
                break;
            case 'edit':
                $actionName = ($locale == 'pt_BR') ? 'editar' : 'edit';
                break;
            case 'del':
                $actionName = ($locale == 'pt_BR') ? 'deletar' : 'del';
                break;
            case 'list':
                $actionName = ($locale == 'pt_BR') ? 'listar' : 'list';
                break;
            case 'view':
                $actionName = ($locale == 'pt_BR') ? 'visualizar' : 'view';
                break;
            case 'image':
                $actionName = ($locale == 'pt_BR') ? 'imagem' : 'image';
                break;
            /*
             * case 'add-image-entity': $actionName = ($locale=='pt_BR') ? 'adicionar-imagem-enti' : 'add-image-entity'; break; case 'list-image-entity': $actionName = ($locale=='pt_BR') ? 'imagem' : 'list-image-entity'; break; case 'del-image-entity': $actionName = ($locale=='pt_BR') ? 'imagem' : 'del-image-entity'; break;

        }

        return $actionName;
    }

    public function getLanguagePtBR()
    {
        return array(
            'Submit' => 'Enviar',
            'Reset' => 'Resetar',
            'Cancel' => 'Cancelar',
            'From' => 'De',
            'To' => 'Até',
            'Match Text' => 'Palavra Chave'
        );
    }

    public function getDictionary()
    {
        switch ($this->getLocale()) {
            case 'pt_BR':
                $data = $this->getLanguagePtBR();
                break;
            case 'en_US':
                $data = $this->getLanguageEnUs();
                break;
            default:
                throw new \Exception('Lingua não encontrada');
                break;
        }

        return $data;
    }

    public function getTranslate($string, $locale = 'pt_BR')
    {
        $data = $this->getDictionary($locale);

        if (isset($data[$string***REMOVED***)) {
            return $data[$string***REMOVED***;
        } else {
            throw new \Exception('Erro em traduzir termo ' . $string . ' para ' . $locale);
        }
        // if()
    }
*/
    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix()
    {
        $this->prefix = $prefix;

        return $this;
    }




}
