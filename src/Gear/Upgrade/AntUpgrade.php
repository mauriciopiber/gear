<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Edge\AntEdge\AntEdgeTrait;

class AntUpgrade extends AbstractJsonService
{
    use AntEdgeTrait;

    use ConsolePromptTrait;

    use ConsoleAwareTrait;

    static public $named = 'Adicionado Nome %s';

    static public $added = 'Criado Target %s';

    static public $shouldAdd = 'Deve adicionar o Target %s?';

    static public $shouldName = 'Deve mudar o nome de %s para %s?';

    static public $shouldDefault = 'Deve mudar o atributo default de %s para %s?';

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

    public function prepare($build)
    {
        $doc = new \DomDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($build->asXML());

        return preg_replace_callback('/^( +)</m', function ($token) {
            return str_repeat(' ', intval(strlen($token[1***REMOVED***) / 2) * 4).'<';
        }, $doc->saveXML());
    }

    public function factoryClean()
    {
        $xml = simplexml_load_string(
<<<EOS
<target name="clean" description="Cleanup build artifacts">
    <delete dir="\${basedir}/build/api"/>
    <delete dir="\${basedir}/build/coverage"/>
    <delete dir="\${basedir}/build/logs"/>
    <delete dir="\${basedir}/build/pdepend"/>
    <delete dir="\${basedir}/build/phpdox"/>
</target>
EOS
        );

        return $xml;
    }

    public function factoryUnitFile()
    {
        $xml = simplexml_load_string(
<<<EOS
    <target name="unit-file" description="Run unit tests with Codeception on a File or Folder" depends="set-vendor, buildHelper">
        <exec executable="\${vendor}/bin/codecept" failonerror="true">
            <arg value="run"/>
            <arg value="unit"/>
            <arg value="test/unit/GearTest/\${test}"/>
        </exec>
    </target>
EOS
        );

        return $xml;
    }

    public function factory($target)
    {
        $xml = null;

        switch ($target) {
            case 'clean':
                $xml = $this->factoryClean();
                break;
            case 'unit-file':
                $xml = $this->factoryUnitFile();
                break;
        }

        if ($xml) {
            return $xml;
        }


        throw new \Exception(
            'Por favor solicite o desenvolvimento do target '. $target.' ou verifique se o nome está correto.'
        );
    }

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

    public function upgrade($edge, $file)
    {
        $file = $this->upgradeName($file);

        $file = $this->upgradeDefault($file, $edge['default'***REMOVED***);

        foreach ($edge['target'***REMOVED*** as $target => $dependency) {

            $dependency = null;

            $hasTarget = $this->buildHasTarget($file, $target);

            if ($hasTarget) {
                continue;
            }

            $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldAdd, $target));

            if ($confirm === false) {
                continue;
            }

            $file = $this->appendChild($file, $this->factory($target));
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

        $newAnt = $this->upgrade($edge, $antModule);

        $pretty = $this->prepare($newAnt);

        file_put_contents($dir.'/build.xml', $pretty);

        return $this->upgrades;
    }

    public function upgradeProject($type = 'web')
    {
        return [***REMOVED***;
    }
}
