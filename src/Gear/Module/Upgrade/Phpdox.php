<?php
namespace Gear\Module\Upgrade;

use Gear\Project\Upgrade\UpgradeInterface;
use Gear\Project\Upgrade\AbstractUpgrade;
use Zend\ServiceManager\ServiceManager;

class Phpdox extends AbstractUpgrade implements UpgradeInterface
{
    public function __construct(ServiceManager $serviceLocator)
    {
        $this->module          = $serviceLocator->get('moduleStructure');
        $this->module->prepare();


        $this->str = $serviceLocator->get('stringService');

        $this->console = $serviceLocator->get('console');

        parent::__construct($serviceLocator);
    }


    public function strictName()
    {
        if ((string) $this->build->project[0***REMOVED***->attributes()->name === $this->str->str('url', $this->module->getModuleName())) {
            return;
        }

        $this->console->writeLine(sprintf('Gear irá corrigir o nome do modulo em phpdox.xml'));
        $this->build->project[0***REMOVED***->attributes()->name = $this->str->str('url', $this->module->getModuleName());
    }

    public function strictSource()
    {
        if ((string) $this->build->project[0***REMOVED***->attributes()->source === './src') {
            return;
        }

        $this->console->writeLine(sprintf('Gear irá corrigir o source do phpdox.xml'));
        $this->build->project[0***REMOVED***->attributes()->source = './src';
    }

    public function upgrade()
    {
        $this->file = $this->module->getMainFolder().'/phpdox.xml';

        if (!is_file($this->file)) {
            $this->create();
            return;
        }

        $this->build = simplexml_load_file($this->file);

        $this->strictName();
        //$this->strictNamespace();
        $this->strictSource();



        $this->persist();
        return;
    }

    public function prepare()
    {
        $doc = new \DomDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($this->build->asXML());
        $xmlString = $doc->saveXML();
        return $xmlString;
    }

    public function persist()
    {
        $xmlString = $this->prepare();
        file_put_contents($this->file, $xmlString);
    }

    public function create()
    {

        $moduleName = $this->str->str('url', $this->module->getModuleName());

        $template = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<phpdox xmlns="http://xml.phpdox.net/config">
	<project name="{$moduleName}" source="./src" workdir="build/phpdox">
		<collector publiconly="false">
			<include mask="*.php" />
		</collector>
		<generator output="build">
			<build engine="html" enabled="true" output="api">
				<file extension="html" />
			</build>
		</generator>
	</project>
</phpdox>
EOS;
        file_put_contents($this->file, $template);
    }

    public function update()
    {

    }
}
