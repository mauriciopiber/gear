<?php
namespace Gear\Mvc\Spec\Feature;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Action\Action;
use GearJson\Db\Db;

class Feature extends AbstractMvcTest
{
    protected $dbLocation;

    public function introspectFromTable(Db $table)
    {
        $this->db = $table;
        $this->tableName = $table->getTable();

        $controller = $this->getSchemaService()->getControllerByDb($table);

        $this->dbLocation = $this->createDirectoryFromIntrospect($controller);

        foreach ($controller->getAction() as $action) {
            $action->setController($controller);
            $action->setDb($table);

            switch ($action->getName()) {
                case 'List':
                    $this->buildListAction($action);

                    break;
                case 'Create':
                    $this->buildCreateAction($action);

                    break;
                case 'Edit':
                    $this->buildEditAction($action);
                    break;

                case 'UploadImage':
                    $this->buildUploadImageAction($action);
                    break;

                case 'View':
                    $this->buildViewAction($action);
                    break;
                case 'Delete':
                    $this->buildDeleteAction($action);

                    break;
                default:
                    throw new Exception('Action not found exception');
                    break;
            }
        }

        return true;
    }

    public function buildUploadImageAction(Action $action)
    {
        return true;
    }

    /**
     * Cria o diretório para adicionar os arquivos do Db -> View
     *
     * @param Controller $controller
     * @return string
     */
    public function createDirectoryFromIntrospect($controller)
    {
        $controllerDir = sprintf(
            '%s/%s',
            $this->getModule()->getPublicJsSpecEndFolder(),
            $this->str('url', str_replace('Controller', '', $controller->getName()))
        );

        if (!is_dir($controllerDir)) {
            $this->getDirService()->mkDir($controllerDir);
        }

        return $controllerDir;
    }

    public function getLocation($controllerName)
    {
        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);

        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        return $location;
    }

    public function getSpecOptions($action)
    {
        return [
            'module' => $this->getModule()->getModuleName(),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'tableLabel' => $this->str('label', $action->getDb()->getTable()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'tableUrl' => $this->str('url', $action->getDb()->getTable()),
        ***REMOVED***;
    }

    /**
     * Cria ação de Criar para as Tabelas no Gear Constructor Db.
     *
     * @param Action $action
     */
    public function buildCreateAction(Action $action)
    {
        $this->db = $action->getDb();

        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));
        $options = $this->getSpecOptions($action);

        $options['sendKeys'***REMOVED*** = $this->buildCreateActionSendKeys();
        $options['expectValues'***REMOVED*** = $this->buildCreateActionExpectValues();
        $options['expectValidateNotNull'***REMOVED*** = $this->buildCreateActionValidateNotNull();

        $options['sendKeysInvalid'***REMOVED*** = $this->buildCreateActionSendKeysInvalid();
        $options['expectValidateInvalid'***REMOVED*** = $this->buildCreateActionValidateInvalid();

        $options['sendKeysMin'***REMOVED*** = $this->buildSendKeysValidateMin();
        $options['expectValidateMin'***REMOVED*** = $this->buildExpectValidateMin();

        $options['sendKeysMax'***REMOVED*** = $this->buildSendKeysValidateMax();
        $options['expectValidateMax'***REMOVED*** = $this->buildExpectValidateMax();

        if ($this->getTableService()->hasUniqueConstraint($this->db->getTable())) {

            $options['sendKeysUnique'***REMOVED*** = $this->buildSendKeysValidateUnique();
            $options['expectUnique'***REMOVED*** = $this->buildExpectValidateUnique();

            $uniqueCreator = $this->getFileCreator();
            $uniqueCreator->setView('template/module/mvc/spec/feature/form.validate.unique.scenario.phtml');
            $uniqueCreator->setOptions($options);

            $options['formValidateUnique'***REMOVED*** = $uniqueCreator->renderTemplate();
        }

        //$options['sendKeysUnique'***REMOVED*** = $this->buildSendKeysValidateUnique();
        //$options['expectValidateUnique'***REMOVED*** = $this->buildExpectValidateUnique();

        $fileCreator = $this->getFileCreator();
        $fileCreator->setView('template/module/mvc/spec/feature/create.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($this->getLocation($action->getController()->getName()));

        return $fileCreator->render();
    }

    public function bddToWhen($value)
    {
        $test = preg_replace('/^      E eu/', '      Quando eu', $value);

        return $test;
    }

    public function buildEditAction(Action $action)
    {
        $this->db = $action->getDb();

        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));
        $options = $this->getSpecOptions($action);

        $fileCreator = $this->getFileCreator();

        $options['expectFixtures'***REMOVED*** = $this->buildCreateActionExpectValues(75, true);
        $options['sendKeys'***REMOVED***       = $this->bddToWhen($this->buildCreateActionSendKeys(55));
        $options['expectValues'***REMOVED***   = $this->buildCreateActionExpectValues(55);

        $fileCreator->setView('template/module/mvc/spec/feature/edit.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($this->getLocation($action->getController()->getName()));

        return $fileCreator->render();
    }

    /**
     * Cria o arquivo list.feature para testes de integração do Mvc
     *
     * @param Action $action
     */
    public function buildListAction(Action $action)
    {
        $this->db = $action->getDb();

        $controllerName = $action->getController()->getName();
        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));

        $options = $this->getSpecOptions($action);

        $options['assert'***REMOVED*** = $this->buildListActionCreateAssert();

        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/list.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($this->getLocation($action->getController()->getName()));

        return $fileCreator->render();
    }

    /**
     * Cria o arquivo delete.feature para testes de Integração do Mvc
     *
     * @param Action $action
     *
     * @return Localização
     */
    public function buildDeleteAction(Action $action)
    {
        $this->db = $action->getDb();

        $controllerName = $action->getController()->getName();
        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));

        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);

        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $options = [
            'module' => $this->getModule()->getModuleName(),
            'table' => $this->str('label', $action->getDb()->getTable()),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'tableUrl' => $this->str('url', $action->getDb()->getTable()),
        ***REMOVED***;

        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/delete.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($location);

        return $fileCreator->render();
    }

    /**
     * Cria arquivo view.featurea para testes de Integração do Mvc
     *
     * @param Action $action
     *
     * @return Localização
     */
    public function buildViewAction(Action $action)
    {
        $this->db = $action->getDb();

        $controllerName = $action->getController()->getName();
        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));

        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);

        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $options = [
            'module' => $this->getModule()->getModuleName(),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'tableLabel' => $this->str('label', $action->getDb()->getTable()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'tableUrl' => $this->str('url', $action->getDb()->getTable()),
        ***REMOVED***;

        $options['assert'***REMOVED*** = $this->buildViewActionCreateAssert();

        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/view.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($location);

        return $fileCreator->render();
    }

    public function validateMaxLengthRule($column)
    {
        if (
            get_class($column) == 'Gear\Column\Varchar\Varchar'
            || get_class($column) == 'Gear\Column\Varchar\PasswordVerify'
        ) {
            return true;
        }

        return false;
    }

    public function validateUniqueRule($column)
    {
        if (!(
            $column instanceof \Gear\Column\Varchar\UniqueId
            || $column instanceof \Gear\Column\Varchar\PasswordVerify
            || $column instanceof \Gear\Column\Varchar\UploadImage
            || $column instanceof \Gear\Column\Int\AbstractCheckbox
            || $column instanceof \Gear\Column\Int\PrimaryKey
            || $column instanceof \Gear\Column\Text\Text
            || $column instanceof \Gear\Column\Int\ForeignKey
            || $column instanceof \Gear\Column\Decimal\MoneyPtBr
            || $column instanceof \Gear\Column\Datetime\DatetimePtBr
            || $column instanceof \Gear\Column\Date\DatePtBr
        )) {
            return true;
        }

        return false;


    }

    public function buildSendKeysValidateUnique()
    {
        $fileText = '';
        $columns = $this->getColumnService()->getColumns($this->db);
        foreach ($columns as $column) {
            if ($this->validateUniqueRule($column)) {

                $fileText .= $column->getIntegrationActionSendKeys(30);
            }
        }

        return $fileText;
    }

    public function buildExpectValidateUnique()
    {
        $fileText = '';
        $columns = $this->getColumnService()->getColumns($this->db);
        foreach ($columns as $column) {
            if ($this->validateUniqueRule($column)) {
                $fileText .= $column->getIntegrationExpectValidateUnique();
            }
        }

        return $fileText;
    }

    /**
     * Cria os sendkeys para o cenário de verificar os valores máximos possíveis na coluna.
     */
    public function buildSendKeysValidateMax()
    {
        $fileText = '';
        $columns = $this->getColumnService()->getColumns($this->db);
        foreach ($columns as $column) {
            if ($this->validateMaxLengthRule($column)) {
                $fileText .= $column->getIntegrationSendKeysValidateMax();
            }
        }

        return $fileText;
    }

    /**
     * Cria os sendkeys para o cenário de verificar os valores mínimos possíveis na coluna.
     */
    public function buildExpectValidateMax()
    {
        $fileText = '';
        $columns = $this->getColumnService()->getColumns($this->db);
        foreach ($columns as $column) {
            if ($this->validateMaxLengthRule($column)) {
                $fileText .= $column->getIntegrationExpectValidateMax();
            }
        }
        return $fileText;
    }

    /**
     * Cria os expect para o cenário de verificar os valores máximos possíveis na coluna.
     */
    public function buildSendKeysValidateMin()
    {
        $fileText = '';
        $columns = $this->getColumnService()->getColumns($this->db);
        foreach ($columns as $column) {
            if ($this->validateMaxLengthRule($column)) {
                $fileText .= $column->getIntegrationSendKeysValidateMin();
            }
        }

        return $fileText;
    }


    /**
     * Cria os expect para o cenário de verificar os valores mínimos possíveis na coluna.
     */
    public function buildExpectValidateMin()
    {
        $fileText = '';
        $columns = $this->getColumnService()->getColumns($this->db);
        foreach ($columns as $column) {
            if ($this->validateMaxLengthRule($column)) {
                $fileText .= $column->getIntegrationExpectValidateMin();
            }
        }
        return $fileText;
    }


    /**
     * Cria o scenário onde verifica os campos obrigatórios e as mensagems de validação.
     *
     * Para cada campo, verifica se ele é nullable ou não.
     *
     * Se o campo for nullable, exibe mensagem verificando se o campo está vazio
     *
     * Se o campo for not nullable, exibe a mensagem de validação de campo obrigatório.
     *
     * Estão excluídos: PrimaryKey, UniqueId, UploadImage, AbstractCheckbox
     */
    public function buildCreateActionValidateNotNull()
    {
        $fileText = '';

        $isNullable = $this->getTableService()->isNullable($this->db->getTable());


        $fileText = $this->buildCreateActionValidateNotNullResponse($isNullable);


        $columns = $this->getColumnService()->getColumns($this->db);

        foreach ($columns as $column) {
            if (
                !($column instanceof \Gear\Column\Int\PrimaryKey
                || $column instanceof \Gear\Column\Varchar\UniqueId
            ) && (
                !(($column instanceof \Gear\Column\Int\AbstractCheckbox
                || $column instanceof \Gear\Column\Varchar\UploadImage)
                && $column->getColumn()->isNullable() === false)
          )) {
                $fileText .= $column->getIntegrationActionIsNullable();
            }
        }

        return $fileText;
    }

    public function buildCreateActionValidateNotNullResponse($boolean)
    {
        $indent = str_repeat(' ', 6);

        $true = 'Então eu vejo a mensagem que foi "Sucesso! Os dados foram salvos corretamente."';
        $false = 'Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"';
        return ($boolean) ? $indent.$true.PHP_EOL : $indent.$false.PHP_EOL;
    }


    /**
     * Cria SendKeys para colunas.
     *
     * Utilizado na feature de Criar e Editar.
     *
     * @return string
     */
    public function buildCreateActionSendKeys()
    {
        $fileText = '';

        $columns = $this->getColumnService()->getColumns($this->db);

        foreach ($columns as $column) {
            if (!($column instanceof \Gear\Column\Int\PrimaryKey
                || $column instanceof \Gear\Column\Varchar\UniqueId
            )) {
                $fileText .= $column->getIntegrationActionSendKeys(55);
            }
        }

        return $fileText;
    }


    public function validateInvalidRule($column)
    {
        if (!($column instanceof \Gear\Column\Int\PrimaryKey
            || $column instanceof \Gear\Column\Varchar\UniqueId
            || $column instanceof \Gear\Column\Text\Text
            || $column instanceof \Gear\Column\Varchar\PasswordVerify
            || $column instanceof \Gear\Column\Int\ForeignKey
            || $column instanceof \Gear\Column\Int\AbstractCheckbox
            || $column instanceof \Gear\Column\Varchar\UploadImage
            || $column instanceof \Gear\Column\DateTime\AbstractDateTime
            || $column instanceof \Gear\Column\Decimal\Decimal
            || $column instanceof \Gear\Column\Int\Int
            || get_class($column) == 'Gear\Column\Varchar\Varchar'
        )) {
                return true;
        }

        return false;
    }

    /**
     * Cria SendKeys para colunas que precisam de validação de formato
     *
     * Utilizado na feature de Criar e Editar.
     *
     * @return string
     */
    public function buildCreateActionSendKeysInvalid()
    {
        $fileText = '';

        $columns = $this->getColumnService()->getColumns($this->db);

        foreach ($columns as $column) {
            if ($this->validateInvalidRule($column)) {
                $fileText .= $column->getIntegrationActionSendKeysInvalid();
            }
        }

        return $fileText;
    }

    /**
     * Validação das Mensagens de Campos Inválidos, relativos ao Formato.
     *
     * @param number $iterator
     * @param string $true
     * @return string
     */
    public function buildCreateActionValidateInvalid($iterator = 55, $true = false)
    {
        $fileText = '';

        $columns = $this->getColumnService()->getColumns($this->db);

        foreach ($columns as $column) {
            if ($this->validateInvalidRule($column)) {
                $fileText .= $column->getIntegrationActionIsInvalid();
            }
        }

        return $fileText;
    }


    public function buildCreateActionExpectValues($iterator = 55, $true = false)
    {
        $fileText = '';

        $columns = $this->getColumnService()->getColumns($this->db);

        foreach ($columns as $column) {
            if (!($column instanceof \Gear\Column\Int\PrimaryKey || $column instanceof \Gear\Column\Varchar\UniqueId)) {
                $fileText .= $column->getIntegrationActionExpectValue($iterator, 1, $true);
            }
        }

        return $fileText;
    }


    public function buildListActionCreateAssert()
    {
        $fileText = '';

        $columns = $this->getColumnService()->getColumns($this->db);

        foreach ($columns as $column) {
            if (!($column instanceof \Gear\Column\Varchar\UniqueId
                || $column instanceof \Gear\Column\Varchar\PasswordVerify
                || $column instanceof \Gear\Column\Varchar\UploadImage
                || $column instanceof \Gear\Column\Text\Html
                || $column instanceof \Gear\Column\Text\Text
                || $column instanceof \Gear\Column\Int\Checkbox
                || $column instanceof \Gear\Column\Tinyint\Checkbox
            )) {
                $fileText .= $column->getIntegrationActionList();
            }
        }

        return $fileText;
    }


    public function buildViewActionCreateAssert()
    {
        $fileText = '';

        $columns = $this->getColumnService()->getColumns($this->db);

        foreach ($columns as $column) {
            if (!($column instanceof \Gear\Column\Int\PrimaryKey
                || $column instanceof \Gear\Column\Varchar\UniqueId
                || $column instanceof \Gear\Column\Varchar\PasswordVerify
            )) {
                $fileText .= $column->getIntegrationActionView();
            }
        }

        return $fileText;
    }



    public function build(Action $action)
    {
        $version = $this->getGearVersion();



        if ($action->getController() instanceof \GearJson\Controller\Controller) {
            $controllerName = $action->getController()->getName();
        } else {
            $controllerName = $action->getController();
        }

        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));
        $nameClass = sprintf('%s%sAction', $controllerName, $action->getName());

        $options = [
            'version' => $version,
            'action' => $this->str('class', $action->getName()),
            'controller' => $this->str('class', $controllerName),
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'actionLabel' => $this->str('label', $action->getName()),
            'controllerLabel' => $this->str('label', $controllerName),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'actionUrl' => $this->str('url', $action->getName()),
            'controllerUrl' => $this->str('url', $controllerName),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***;

        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);


        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $name = sprintf('%s.js', $nameClass);


        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/action.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($location);

        return $fileCreator->render();
    }

    public function createIndexFeature($projectName = 'PiberNetwork')
    {

        return $this->getFileCreator()->createFile(
            'template/module/mvc/spec/feature/index.feature.phtml',
            array(
                //'module' => $this->getModule()->getModuleName(),
                //'project' => $this->str('label', $projectName),
                'project' => $projectName,
                'module' => $this->str('label', $this->getModule()->getModuleName())
            ),
            'index.feature',
            $this->getModule()->getPublicJsSpecEndFolder().'/index'
        );
    }
}
