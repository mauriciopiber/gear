<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Edge\AntEdge\AntEdgeTrait;
use Gear\Project\ProjectLocationTrait;

/**
 * Responsável por criar a build.xml
 */
class AntUpgrade extends AbstractJsonService
{
    use ProjectLocationTrait;

    use AntEdgeTrait;

    use ConsolePromptTrait;

    use ConsoleAwareTrait;

    static public $named = 'Adicionado Nome %s';

    static public $added = 'Criado Target %s';

    static public $shouldAdd = 'Deve adicionar o Target %s?';

    static public $shouldName = 'Deve mudar o nome de %s para %s?';

    static public $shouldDefault = 'Deve mudar o atributo default de %s para %s?';

    static public $shouldDepends = 'Deve mudar a dependência da build %s para %s?';

    static public $depends = 'Adicionado dependência do target %s para %s';

    static public $created = 'Arquivo %s do %s criado';

    static public $confirm = 'Deseja criar arquivo %s?';

    static public $default = 'Adicionado Build Default %s';

    public function __construct($console, $consolePrompt, $string, $module = null)
    {
        $this->console = $console;
        $this->module = $module;
        $this->stringService = $string;
        $this->consolePrompt = $consolePrompt;
    }

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
     * Formata o XML para pode ser impresso.
     *
     * @param \SimpleXmlElement $build XML que será impresso.
     */
    public function prepare(\SimpleXmlElement $build)
    {
        $doc = new \DomDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($build->asXML());

        return preg_replace_callback('/^( +)</m', function ($token) {
            return str_repeat(' ', intval(strlen($token[1***REMOVED***) / 2) * 4).'<';
        }, $doc->saveXML());
    }

    public function projectFactory($target, $type= 'web')
    {
        $xml = null;

        $template = (new \Gear\Module())->getLocation().'/../../view/template/project/ant';

        return $this->factory($target, $template, $type);
    }

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

    public function moduleFactory($target, $type = 'web')
    {
        $xml = null;

        $template = (new \Gear\Module())->getLocation().'/../../view/template/module/ant';

        return $this->factory($target, $template, $type);
    }

    /**
     * Adiciona um elemento dentro de outro element.
     *
     * @param \SimpleXMLElement $to
     * @param \SimpleXMLElement $from
     * @return SimpleXMLElement
     */
    public function appendChild(\SimpleXMLElement &$to, \SimpleXMLElement $from)
    {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
        return simplexml_import_dom($toDom);
    }

    public function upgradeName(\SimpleXmlElement $file)
    {
        $buildName = $this->str('url', $this->getModule()->getModuleName());

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

    public function upgrade($edge, $file, $function, $type = 'web')
    {
        $file = $this->upgradeName($file);

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

    public function upgradeModule($type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        $edge = $this->getAntEdge()->getAntModule($type);

        if (!isset($edge['target'***REMOVED***) && !isset($edge['default'***REMOVED***)) {
            return $this->upgrades;
        }

        $dir = $this->getModule()->getMainFolder();

        $antModule = simplexml_load_file($dir.'/build.xml');

        $newAnt = $this->upgrade($edge, $antModule, __FUNCTION__, $type);

        $pretty = $this->prepare($newAnt);

        file_put_contents($dir.'/build.xml', $pretty);

        return $this->upgrades;
    }

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
