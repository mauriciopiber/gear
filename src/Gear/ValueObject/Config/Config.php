<?php
namespace Gear\ValueObject\Config;

/**
 *
 * @author piber
 *
 */
class Config
{

    /**
    protected $tables = array();

    protected $specialty;

    protected $driver;

    protected $entityManager;

    protected $serviceLocator;

    protected $locale;

    protected $safeColumns = array();

    protected $fixtureException;

     */
    protected $path;

    protected $module;


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

        /*
        $this->prefix = $prefix;
        $this->speciality = $speciality;

        $this->dbException = array(
            'Created',
            'Updated',
            'created',
            'updated',
            'id_lixeira',
            'idLixeira',
            'IdLixeira'
        );

        $this->fixtureException = array_slice($this->dbException, 0, 4);

        $this->safeColumns = array(
            'titulo',
            'title',
            'nome',
            'name'
        );

        $this->tables = [***REMOVED***;

        if ($tables == 'db') {
            $this->tables = $this->getEntitiesFromDB();
        } elseif ($tables == 'entity') {
            $this->tables = $this->getEntitiesFromEntity($makeGear->str('class', $module));
        } elseif (is_array($tables)) {
            $this->tables = [***REMOVED***;
            if (count($tables) > 0) {
                foreach ($tables as $i => $v) {
                    $this->tables[***REMOVED*** = $makeGear->str('uline', $v);
                }
            }
        } else {
            $this->tables[***REMOVED*** = $makeGear->str('uline', $tables);
        }
        // var_dump($driver);die();
        if ($driver != null) {
            $this->driver = $driver->driver;
        }
        if ($entityManager != null) {
            $this->entityManager = $entityManager->get('doctrine.entitymanager.orm_default');
        }

        $this->setServiceLocator($entityManager);

        $this->locale = 'pt_BR';
        */
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

    public function getModuleConfigFile()
    {
        return $this->getModuleFolder().'/config/module.config.php';
    }

    public function getModuleTestUnit()
    {
        return $this->getLocal().'/module/'.$this->getModule().'/test/unit/'.$this->getModule();
    }

    public function getModuleFile()
    {
        return $this->getSrc().'/Module.php';
    }

    public function getSrc()
    {
        return $this->getModuleFolder().'/src/'.$this->getModule();
    }

    public function getView()
    {
        $makeGear = new \Gear\Model\MakeGear();

        return $this->getModuleFolder().'/view/'.$makeGear->str('url', $this->getModule());
    }

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
             */
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

    public function getDbException()
    {
        return $this->dbException;
    }

    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    public function getDriver()
    {
        return $this->driver;
    }
    /**
     * Função responsável por listar as entidades do projeto/modulo e retornar um array com os nomes das tabelas que deverão ser processadas.
     */
    public function getEntitiesFromEntity($module)
    {

        $makeGear = new \Gear\Model\MakeGear();

        $entityFolder = $this->getLocal() . '/module/' . $module . '/src/' . $module . '/Entity';
        $keys = array();
        foreach (glob($entityFolder . '/*.*') as $file) {

            if (! (strpos($file, '~') !== false)) {

                $keys[***REMOVED*** = $makeGear->str('uline', (basename(str_replace('.php', '', $file))));
            }
        }

        // var_dump($keys);die();
        return $keys;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

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

    public function getTables()
    {
        return $this->tables;
    }

    public function setTables($tables)
    {
        $this->tables = $tables;

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

    public function getSpecialty()
    {
        return $this->specialty;
    }

    public function setSpecialty($specialty)
    {
        $this->specialty = $specialty;

        return $this;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    public function getSafeColumns()
    {
        return $this->safeColumns;
    }

    public function setSafeColumns($safeColumns)
    {
        $this->safeColumns = $safeColumns;

        return $this;
    }

    public function getFixtureException()
    {
        return $this->fixtureException;
    }

    public function setFixtureException($fixtureException)
    {
        $this->fixtureException = $fixtureException;

        return $this;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }
}
