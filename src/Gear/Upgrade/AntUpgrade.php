<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Edge\AntEdge\AntEdgeTrait;
use Gear\Project\ProjectLocationTrait;

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

    /**
     * @var array
     */
    public $config = [***REMOVED***;

    static public $shouldFile = 'Ant - Você quer criar o arquivo build.xml?';

    static public $fileCreated = 'Ant - Arquivo build.xml criado';

    static public $named = 'Ant - Adicionado Nome %s';

    static public $added = 'Ant - Criado Target %s';

    static public $shouldAdd = 'Ant - Deve adicionar o Target %s?';

    static public $shouldName = 'Ant - Deve mudar o nome de %s para %s?';

    static public $shouldDefault = 'Ant - Deve mudar o atributo default de %s para %s?';

    static public $shouldDepends = 'Ant - Deve mudar a dependência da build %s para %s?';

    static public $depends = 'Ant - Adicionado dependência do target %s para %s';

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
    public function __construct($console, $consolePrompt, $string, $config, $module = null)
    {
        $this->console = $console;
        $this->module = $module;
        $this->stringService = $string;
        $this->config = $config;
        $this->consolePrompt = $consolePrompt;
    }

    /**
     * Iterate over the build to search for target named by $search param.
     *
     * @param \SimpleXMLElement $build  Object XML com Build
     * @param string            $search Nome do Target
     *
     * @return boolean
     */
    public function buildHasTarget(\SimpleXMLElement $build, $search)
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
    public function buildTargetHasDepends(\SimpleXmlElement $build, $search, $depends)
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
    public function appendDepends(\SimpleXmlElement $build, $search, $depends)
    {
        foreach ($build[0***REMOVED***->target as $target) {
            $name = (string) $target[0***REMOVED***->attributes()->name;


            if ($name === $search) {
                if (empty((string) $target[0***REMOVED***->attributes()->depends)) {
                    $target[0***REMOVED***->addAttribute('depends', $depends);
                } else {
                    $target[0***REMOVED***->attributes()->depends = $depends;
                }

                $this->upgrades[***REMOVED*** = sprintf(static::$depends, $search, $depends);
                break;
            }
        }

        return $build;
    }

    /**
     * Format XML before print
     *
     * @param \SimpleXmlElement $build XML que será impresso.
     *
     * @return string
     */
    public function prepare(\SimpleXmlElement $build)
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
        $xml = null;

        $template = (new \Gear\Module())->getLocation().'/../../view/template/project/ant';

        return $this->factory($target, $template, $type);
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
            return simplexml_load_file($file);
        }

        $fileType = $template.'/'.$type.'/'.$target.'.xml';

        if (is_file($fileType)) {
            return simplexml_load_file($fileType);
        }

        throw new \Exception(
            'Não foi possível carregar o template '.$target.', verifique'
        );
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
        $xml = null;

        $template = (new \Gear\Module())->getLocation().'/../../view/template/module/ant';

        return $this->factory($target, $template, $type);
    }

    /**
     * Append a XML element as Child of Another Xml Element.
     *
     * @param \SimpleXMLElement $to   Xml who accepts a new child.
     * @param \SimpleXMLElement $from Child XMl
     *
     * @return SimpleXMLElement
     */
    public function appendChild(\SimpleXMLElement &$to, \SimpleXMLElement $from)
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
    public function upgradeName($name, \SimpleXmlElement $file)
    {
        $buildName = $this->str('url', $name);

        if ((string) $file->attributes()->name == $buildName) {
            return $file;
        }

        $confirm = $this->getConsolePrompt()->show(
            sprintf(
                static::$shouldName,
                $file->attributes()->name,
                $buildName
            )
        );

        if ($confirm === false) {
            return $file;
        }

        $this->upgrades[***REMOVED*** = sprintf(static::$named, $buildName);
        $file->attributes()->name = $buildName;
        return $file;
    }

    /**
     * Upgrade the build default into file
     *
     * @param \SimpleXmlElement $file    Build File
     * @param string            $default Expected Default Build
     *
     * @return \SimpleXmlElement
     */
    public function upgradeDefault(\SimpleXmlElement $file, $default)
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
    public function upgrade($edge, $file, $function, $type = 'web')
    {
        if ($function == 'upgradeModule') {
            $name = $this->getModule()->getModuleName();
        }

        if ($function == 'upgradeProject') {
            $name = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;
        }

        $file = $this->upgradeName($name, $file);

        $file = $this->upgradeDefault($file, $edge['default'***REMOVED***);

        foreach ($edge['target'***REMOVED*** as $target => $dependency) {
            $hasTarget = $this->buildHasTarget($file, $target);

            if ($hasTarget) {
                if (empty($dependency)) {
                    continue;
                }

                $hasDepends = $this->buildTargetHasDepends($file, $target, $dependency);

                if ($hasDepends === true) {
                    continue;
                }

                $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldDepends, $target, $dependency));

                if ($confirm === false) {
                    continue;
                }

                $file = $this->appendDepends($file, $target, $dependency);

                continue;
            }

            $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldAdd, $target));

            if ($confirm === false) {
                continue;
            }

            switch ($function) {
                case 'upgradeModule':
                    $file = $this->appendChild($file, $this->moduleFactory($target, $type));
                    break;
                case 'upgradeProject':
                    $file = $this->appendChild($file, $this->projectFactory($target, $type));
                    break;
            }


            $this->upgrades[***REMOVED*** = sprintf(static::$added, $target);
        }

        return $file;
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

        if (!is_file($dir.'/build.xml')) {

            $confirm = $this->getConsolePrompt()->show(static::$shouldFile);

            if ($confirm === false) {
                return [***REMOVED***;
            }

            $basic = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="" default="" basedir=".">
</project>

EOS;
            file_put_contents($dir.'/build.xml', $this->prepare(simplexml_load_string($basic)));

            $this->upgrades[***REMOVED*** = static::$fileCreated;


        }

        $antModule = simplexml_load_file($dir.'/build.xml');

        $newAnt = $this->upgrade($edge, $antModule, __FUNCTION__, $type);

        $pretty = $this->prepare($newAnt);

        file_put_contents($dir.'/build.xml', $pretty);

        return $this->upgrades;
    }

    /**
     * Upgrade a project ant build based on the Edge
     *
     * @param string $type Project Type
     *
     * @return array Upgrade Messages
     */
    public function upgradeProject($type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        $edge = $this->getAntEdge()->getAntProject($type);

        if (!isset($edge['target'***REMOVED***) && !isset($edge['default'***REMOVED***)) {
            return $this->upgrades;
        }

        $dir = $this->getProject();

        $antModule = simplexml_load_file($dir.'/build.xml');

        $newAnt = $this->upgrade($edge, $antModule, __FUNCTION__, $type);

        $pretty = $this->prepare($newAnt);

        file_put_contents($dir.'/build.xml', $pretty);

        return $this->upgrades;
    }
}
