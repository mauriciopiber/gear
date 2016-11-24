<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Edge\AntEdge\AntEdgeTrait;
use Gear\Project\ProjectLocationTrait;
use GearBase\Config\GearConfigTrait;
use GearBase\Config\GearConfig;
use SimpleXmlElement;
use Exception;

/**
 * Cria arquivos build.xml para a ferramenta Ant baseado em configuraçao edge yml.
 *
 * Pertence ao comando de upgrade, responsável por atualizar os arquivos de projetos e módulos.
 *
 * @category   Upgrade
 * @package    Gear
 * @subpackage Upgrade
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */
class AntUpgrade extends AbstractJsonService
{
    use ProjectLocationTrait;

    use AntEdgeTrait;

    use ConsolePromptTrait;

    use ConsoleAwareTrait;

    use GearConfigTrait;

    /**
     * @var array
     */
    public $config = [***REMOVED***;

    public $upgrades = [***REMOVED***;

    public $import = [***REMOVED***;

    static public $shouldFile = 'Ant - Você quer criar o arquivo %s?';

    static public $fileCreated = 'Ant - Arquivo %s criado';

    static public $named = 'Ant - Adicionado nome %s no arquivo %s';

    static public $added = 'Ant - Criado Target %s no arquivo %s';

    static public $shouldAdd = 'Ant - Deve adicionar o Target %s?';

    static public $shouldName = 'Ant - Deve mudar o nome de %s para %s?';

    static public $shouldDefault = 'Ant - Deve mudar o atributo default de %s para %s?';

    static public $shouldDepends = 'Ant - Deve mudar a dependência "%s" para "%s" em %s no arquivo %s?';

    static public $shouldImport = 'Ant - Deve adicionar o import %s para %s?';

    static public $imports = 'Ant - Adicionado import %s para %s';

    static public $depends = 'Ant - Alterado dependência de "%s" para "%s" em %s no arquivo %s';

    static public $created = 'Ant - Arquivo %s do %s criado';

    static public $confirm = 'Ant - Deseja criar arquivo %s?';

    static public $default = 'Ant - Adicionado Build Default %s';

    /**
     * Construtor
     *
     * @param Zend\Console\Adapter\Posix         $console       Console para exibir mensagens
     * @param Gear\Util\Prompt\ConsolePrompt     $consolePrompt Ferramenta pra manipular interações de usuário
     * @param GearBase\Util\String\StringService $string        Ferramenta para manipular String
     * @param array                              $config        Configuração
     * @param Gear\Module\BasicModuleStructure   $module        Estrutura do Módulo
     */
    public function __construct($console, $consolePrompt, $string, $config, $module = null, GearConfig $gearConfig)
    {
        $this->console = $console;
        $this->module = $module;
        $this->stringService = $string;
        $this->config = $config;
        $this->consolePrompt = $consolePrompt;
        $this->gearConfig = $gearConfig;
        $this->upgrades = [***REMOVED***;
    }

    /**
     * Iterate over the build to search for target named by $search param.
     *
     * @param \SimpleXMLElement $build  Object XML com Build
     * @param string            $search Nome do Target
     *
     * @return boolean
     */
    public function buildHasTarget(SimpleXMLElement $build, $search)
    {
        foreach ($build[0***REMOVED***->target as $target) {
            $name = (string) $target[0***REMOVED***->attributes()->name;
            if ($name === $search) {
                return true;
            }
        }
        return false;
    }

    /**
     * Busca na Build se existe determinado build com depends
     *
     * @param \SimpleXMLElement $build   Object XML com Build
     * @param string            $search  Nome do Target
     * @param string            $depends Dependência do Target
     *
     * @return boolean
     */
    public function buildTargetHasDepends(SimpleXmlElement $build, $search, $depends)
    {
        foreach ($build[0***REMOVED***->target as $target) {
            $name = (string) $target[0***REMOVED***->attributes()->name;
            if ($name === $search) {
                $actual = (string) $target[0***REMOVED***->attributes()->depends;

                if ($actual == $depends) {
                    return true;
                }

                return false;
            }
        }

        return false;
    }

    /**
     * Append a new Depends on a Target of Build, based on target name.
     *
     * @param \SimpleXmlElement $build   Ant Build
     * @param string            $search  Target Name
     * @param string            $depends Target Depends
     *
     * @return \SimpleXmlElement
     */
    public function appendDepends(SimpleXmlElement $build, $search, $depends, $identity = 'build.xml')
    {
        foreach ($build[0***REMOVED***->target as $target) {
            $name = (string) $target[0***REMOVED***->attributes()->name;

            if ($name === $search) {

                $attrs = $target[0***REMOVED***->attributes();

                if (!isset($attrs['depends'***REMOVED***)) {
                    $attrsDepends = '';
                    $target[0***REMOVED***->addAttribute('depends', $depends);
                } else {
                    $attrsDepends = (string) $target[0***REMOVED***->attributes()->depends;
                    $target[0***REMOVED***->attributes()->depends = $depends;
                }

                $this->upgrades[***REMOVED*** = sprintf(static::$depends, $attrsDepends, $depends, $search, $identity);
                break;
            }
        }

        return $build;
    }

    public function factoryImport($name)
    {
        $import = file_get_contents($this->getModuleTemplate().'/import.xml');
        $import = str_replace('{$IMPORT}', $name, $import);

        return $import;
    }

    /**
     * Format XML before print
     *
     * @param \SimpleXmlElement $build XML que será impresso.
     *
     * @return string
     */
    public function prepare(SimpleXmlElement $build)
    {
        $doc = new \DomDocument('1.0', 'utf-8');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($build->asXML());

        return preg_replace_callback('/^( +)</m', function ($token) {
            return str_repeat(' ', intval(strlen($token[1***REMOVED***) / 2) * 4).'<';
        }, $doc->saveXML());
    }

    /**
     * Create a target from template for Project
     *
     * @param string $target Target Name
     * @param string $type   Module Type
     *
     * @return SimpleXMLElement
     */
    public function projectFactory($target, $type = 'web')
    {
        $template = $this->getProjectTemplate();

        return $this->factory($target, $template, $type);
    }


    public function getProjectTemplate()
    {
        return (new \Gear\Module())->getLocation().'/../../view/template/project/ant';
    }


    /**
     * Create a Xml Object from a Template
     *
     * @param string $target   Target Name
     * @param string $template Target Template
     * @param string $type     Module Type
     *
     * @throws \Exception
     *
     * @return SimpleXMLElement
     */
    public function factory($target, $template, $type)
    {
        if ($target === null) {
            throw new \Exception(
                'Por favor solicite o desenvolvimento do target '. $target.' ou verifique se o nome está correto.'
            );
        }

        $file = $template.'/'.$target.'.xml';

        if (is_file($file)) {
            $content = file_get_contents($file);

            $content = $this->replacePlaceholder($content);

            return simplexml_load_string($content);
        }

        $fileType = $template.'/'.$type.'/'.$target.'.xml';

        if (is_file($fileType)) {
            $content = file_get_contents($fileType);

            $content = $this->replacePlaceholder($content);

            return simplexml_load_string($content);
        }

        throw new \Exception(
            'Não foi possível carregar o template '.$target.', verifique'
        );
    }

    public function replacePlaceholder($file)
    {
        if (strpos($file, '{$module}') !== false) {
            $file = str_replace('{$module}', $this->getModule()->getModuleName(), $file);
        }
        return $file;
    }

    /**
     * Create a target from template for Module
     *
     * @param string $target Target Name
     * @param string $type   Module Type
     *
     * @return SimpleXMLElement
     */
    public function moduleFactory($target, $type = 'web')
    {
        return $this->factory($target, $this->getModuleTemplate(), $type);
    }

    public function getModuleTemplate()
    {
        $template = (new \Gear\Module())->getLocation().'/../../view/template/module/ant';
        return $template;
    }

    /**
     * Append a XML element as Child of Another Xml Element.
     *
     * @param \SimpleXMLElement $to   Xml who accepts a new child.
     * @param \SimpleXMLElement $from Child XMl
     *
     * @return SimpleXMLElement
     */
    public function appendChild(SimpleXMLElement &$to, SimpleXMLElement $from)
    {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
        return simplexml_import_dom($toDom);
    }

    /**
     * Upgrade the build name into file
     *
     * @param string            $name Expected Name
     * @param \SimpleXmlElement $file Build File
     *
     * @return \SimpleXmlElement
     */
    public function upgradeName(SimpleXmlElement $file, $dir, $name, $identify = 'build.xml')
    {
        $buildName = $this->str('url', $name);

        if (((string) $file->attributes()->name == $buildName) === false) {

            if (($confirm = $this->shouldRename($file, $buildName)) !== false) {
                $this->upgrades[***REMOVED*** = sprintf(static::$named, $buildName, $identify);
                $file->attributes()->name = $buildName;
            }
        }

        return $file;
    }


    public function shouldRename(SimpleXmlElement $file, $buildName)
    {
        return $this->getConsolePrompt()->show(
            sprintf(
                static::$shouldName,
                $file->attributes()->name,
                $buildName
            )
        );
    }

    /**
     * Upgrade the build default into file
     *
     * @param \SimpleXmlElement $file    Build File
     * @param string            $default Expected Default Build
     *
     * @return \SimpleXmlElement
     */
    public function upgradeDefault(SimpleXmlElement $file, $default)
    {

        if ((string) $file->attributes()->default == $default) {
            return $file;
        }

        $confirm = $this->getConsolePrompt()->show(
            sprintf(
                static::$shouldDefault,
                (string) $file->attributes()->default,
                $default
            )
        );

        if ($confirm === false) {
            return $file;
        }

        $file->attributes()->default = $default;
        $this->upgrades[***REMOVED*** = sprintf(static::$default, $default);

        return $file;
    }

    public function getImport($dir, array $edge)
    {
        if (!isset($edge['files'***REMOVED***) || empty($edge['files'***REMOVED***)) {
            return null;
        }

        $builds = [***REMOVED***;

        foreach ($edge['files'***REMOVED*** as $file => $targets) {
            unset($targets);

            $name = sprintf('test/%s.xml', $file);

            $builds[$file***REMOVED*** = simplexml_load_string(file_get_contents($dir.'/'.$name));
        }

        return $builds;
    }

    public function shouldDepends($build, $target, $dependency, $identify = 'build.xml')
    {
        $old = '';
        foreach ($build[0***REMOVED***->target as $targetType) {
            $name = (string) $targetType[0***REMOVED***->attributes()->name;

            if ($name === $target) {
                $old = (string) $targetType[0***REMOVED***->attributes()->depends;
            }
        }

        return $this->getConsolePrompt()->show(sprintf(static::$shouldDepends, $old, $dependency, $target, $identify));
    }

    /**
     * Upgrade build file
     *
     * @param array  $edge     Edge Technologic File
     * @param string $file     File to Upgrade to Edge
     * @param string $function Function calling the upgrade as __FUNCION__
     * @param string $type     Module/Project Type
     *
     * @return SimpleXmlElement|\Gear\Upgrade\SimpleXMLElement
     */
    public function upgrade($dir, $type = 'web', $edge, $function)
    {
        $name = $this->getGearConfig()->getCurrentName();
        $name = $this->str('url', $name);

        $this->createFiles($dir, $edge);

        $this->main = simplexml_load_file($dir.'/build.xml');

        $this->import = $this->getImport($dir, $edge);

        $this->upgradeImport($this->main, $dir, $edge);

        $this->upgradeDefault($this->main, $edge['default'***REMOVED***);

        $this->upgradeName($this->main, $dir, $name);


        if (!empty($this->import)) {

            foreach ($this->import as $nameImport => $build) {

                $matches = array();
                preg_match('/ant-([a-z***REMOVED***+)/', $nameImport, $matches);

                $hasName = sprintf('%s-%s', $name, $matches[1***REMOVED***);

                $this->import[$nameImport***REMOVED*** = $this->upgradeName($build, $dir, $hasName, sprintf('test/%s.xml', $nameImport));
            }

        }


        foreach ($edge['target'***REMOVED*** as $target => $dependency) {
            $this->main = $this->upgradeTarget($this->main, $target, $dependency, $function, $type, 'build.xml');
        }


        if (!empty($this->import)) {

            foreach ($this->import as $name => $build) {

                if (!isset($edge['files'***REMOVED***[$name***REMOVED***) || empty($edge['files'***REMOVED***[$name***REMOVED***)) {
                   continue;
                }

                foreach ($edge['files'***REMOVED***[$name***REMOVED*** as $target => $dependency) {

                    $identify = sprintf('test/%s.xml', $name);

                    $this->import[$name***REMOVED*** = $this->upgradeTarget(
                        $this->import[$name***REMOVED***,
                        $target,
                        $dependency,
                        $function,
                        $type,
                        $identify
                    );
                }

            }
        }

        file_put_contents($dir.'/build.xml', $this->prepare($this->main));

        if (!empty($this->import)) {
            foreach ($this->import as $name => $build) {

                $final = sprintf('%s/test/%s.xml', $dir, $name);
                file_put_contents($final, $this->prepare($build));
            }
        }

        return $this->main;
    }

    public function upgradeTarget(SimpleXmlElement $build, $target, $dependency, $function, $type, $identify = 'build.xml')
    {
         $hasTarget = $this->buildHasTarget($build, $target);

         if ($hasTarget) {
            if (
                empty($dependency)
                || $this->buildTargetHasDepends($build, $target, $dependency) === true
              || $this->shouldDepends($build, $target, $dependency, $identify) === false
           ) {
                return $build;
            }

            $build = $this->appendDepends($build, $target, $dependency, $identify);

            return $build;
        }

        if (($confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldAdd, $target))) === false) {
            continue;
        }

        switch ($function) {
            case 'upgradeModule':
                $build = $this->appendChild($build, $this->moduleFactory($target, $type));
                break;
            case 'upgradeProject':
                $build = $this->appendChild($build, $this->projectFactory($target, $type));
                break;
        }


        $this->upgrades[***REMOVED*** = sprintf(static::$added, $target, $identify);

        return $build;
    }

    public function hasImport(SimpleXmlElement $build, $importName)
    {
        $search = sprintf('./test/%s.xml', $importName);

        foreach ($build[0***REMOVED***->import as $target) {
            $name = (string) $target[0***REMOVED***->attributes()->file;
            if ($name === $search) {
                return true;
            }
        }

        return false;
    }

    public function addImport(SimpleXmlElement $build, $importName)
    {
        $factory = $this->factoryImport($importName);

        $this->appendChild($build, simplexml_load_string($factory));

        $this->upgrades[***REMOVED*** = sprintf(static::$imports, $importName, 'build.xml');

        return $build;
    }

    public function upgradeImport(SimpleXmlElement $build, $dir, array $edge)
    {
        if (empty($edge['import'***REMOVED***)) {
            return true;
        }


        foreach ($edge['import'***REMOVED*** as $importName) {

            if ($this->hasImport($build, $importName) === false) {
                $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldImport, $importName, 'build.xml'));

                if ($confirm === false) {
                    continue;
                }

                $build = $this->addImport($build, $importName);
            }
        }

        return $build;
    }


    public function createFiles($dir, array $edge)
    {

        if (!is_file($dir.'/build.xml')) {
            $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldFile, 'build.xml'));

            if ($confirm === false) {
                return [***REMOVED***;
            }

            $this->createBasicFile($dir, 'build.xml');
            //$this->upgrades[***REMOVED*** = sprintf(static::$fileCreated, 'build.xml');
        }


        if (!isset($edge['files'***REMOVED***) || count($edge['files'***REMOVED***)<1) {
            return;
        }


        foreach ($edge['files'***REMOVED*** as $expectedFile => $targets) {


            if (strpos($expectedFile, 'ant-') === false) {
                continue;
            }

            if (!is_file($dir . '/test/'.$expectedFile.'.xml')) {

                $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldFile, 'test/'.$expectedFile.'.xml'));

                if ($confirm === false) {
                    continue;
                }


                $this->createBasicFile($dir, 'test/'.$expectedFile.'.xml');
                //$this->upgrades[***REMOVED*** = sprintf(static::$fileCreated, $expectedFile.'.xml');

            }
        }

        return true;
    }

    /**
     * Upgrade a module based on the Type and Edge
     *
     * @param string $type Module Type
     *
     * @return array Ugrade Messages
     */
    public function upgradeModule($type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        $edge = $this->getAntEdge()->getAntModule($type);

        if (!isset($edge['target'***REMOVED***) && !isset($edge['default'***REMOVED***)) {
            return $this->upgrades;
        }

        $dir = $this->getModule()->getMainFolder();

        $this->upgrade($dir, $type, $edge, __FUNCTION__);

        return $this->upgrades;
    }

    /**
     * Upgrade a project ant build based on the Edge
     *
     * @param string $type Project Type
     *
     * @return array Upgrade Messages
     */
    public function upgradeProject($name = null, $type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        $edge = $this->getAntEdge()->getAntProject($type);

        if (!isset($edge['target'***REMOVED***) && !isset($edge['default'***REMOVED***)) {
            return $this->upgrades;
        }

        $dir = $this->getProject();

        $this->upgrade($dir, $type, $edge, __FUNCTION__);

        return $this->upgrades;
    }

    public function createBasicFile($dir, $name = 'build.xml')
    {

        $basic = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="" default="" basedir=".">
</project>

EOS;
        file_put_contents(sprintf('%s/%s', $dir, $name), $this->prepare(simplexml_load_string($basic)));

        $this->upgrades[***REMOVED*** = sprintf(static::$fileCreated, $name);
    }
}
