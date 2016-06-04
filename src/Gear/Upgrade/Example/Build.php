<?php
namespace Gear\Module\Upgrade;

use Gear\Project\Upgrade\UpgradeInterface;
use Gear\Project\Upgrade\AbstractUpgrade;
use Zend\ServiceManager\ServiceManager;

class Build extends AbstractUpgrade implements UpgradeInterface
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
        if ((string) $this->build->attributes()->name === $this->str->str('url', $this->module->getModuleName())) {
            return;
        }

        $this->console->writeLine(sprintf('Gear irá corrigir o nome do modulo em build.xml'));
        $this->build->attributes()->name = $this->str->str('url', $this->module->getModuleName());
    }

    public function buildHasTarget($search)
    {
        foreach ($this->build[0***REMOVED***->target as $target) {
            $name = (string) $target[0***REMOVED***->attributes()->name;
            if ($name === $search) {
                return true;
            }
        }

        return false;
    }

    public function getTarget($search)
    {
        foreach ($this->build[0***REMOVED***->target as $i => $targetInFile) {
            $name = (string) $targetInFile[0***REMOVED***->attributes()->name;
            if ($name === $search) {
                return $i;
            }
        }

        return false;
    }


    public function strictSetVendor()
    {
        if ($this->buildHasTarget('set-vendor') === false) {
            $this->console->writeLine(sprintf('Gear irá adicionar o target set-vendor ao build.xml'));
            $cs = $this->build->addChild('target', '');
            $cs->addAttribute('name', 'set-vendor');
            $cs->addAttribute('depends', 'isRunningAsModule, isRunningAsVendor, isRunningAsProject');
        }

        if ($this->buildHasTarget('isRunningAsModule') === false) {
            $this->console->writeLine(sprintf('Gear irá adicionar o target isRunningAsModule ao build.xml'));
            $this->addIsRunningAs('isRunningAsModule', 'check.runningAsModule', '${basedir}/../../vendor');
        }

        if ($this->buildHasTarget('isRunningAsVendor') === false) {
            $this->console->writeLine(sprintf('Gear irá adicionar o target isRunningAsVendor ao build.xml'));
            $this->addIsRunningAs('isRunningAsVendor', 'check.runningAsVendor', '${basedir}/../../../vendor');
        }

        if ($this->buildHasTarget('isRunningAsProject') === false) {
            $this->console->writeLine(sprintf('Gear irá adicionar o target isRunningAsProject ao build.xml'));
            $this->addIsRunningAs('isRunningAsProject', 'check.runningAsProject', '${basedir}/vendor');
        }


        if ($this->buildHasTarget('check.runningAsModule') === false) {
            $this->console->writeLine(sprintf('Gear irá adicionar o target check.runningAsModule ao build.xml'));
            $this->addCheckRunningAs('check.runningAsModule', '${basedir}/../../vendor');
        }

        if ($this->buildHasTarget('check.runningAsVendor') === false) {
            $this->console->writeLine(sprintf('Gear irá adicionar o target check.runningAsVendor ao build.xml'));
            $this->addCheckRunningAs('check.runningAsVendor', '${basedir}/../../../vendor');
        }

        if ($this->buildHasTarget('check.runningAsProject') === false) {
            $this->console->writeLine(sprintf('Gear irá adicionar o target check.runningAsProject ao build.xml'));
            $this->addCheckRunningAs('check.runningAsProject', '${basedir}/vendor');
        }

    }

    public function addCheckRunningAs($name, $vendor)
    {
        $cs = $this->build->addChild('target', '');
        $cs->addAttribute('name', $name);

        $css = $cs->addChild('condition', '');
        $css->addAttribute('property', 'dir.exists');

        $csss = $css->addChild('available', '');
        $csss->addAttribute('file', $vendor);
        $csss->addAttribute('type', 'dir');
    }

    public function addIsRunningAs($name, $check, $vendor)
    {
        $cs = $this->build->addChild('target', '');
        $cs->addAttribute('name', $name);
        $cs->addAttribute('depends', $check);
        $cs->addAttribute('if', 'dir.exists');

        $css = $cs->addChild('property', '');
        $css->addAttribute('name', 'vendor');
        $css->addAttribute('value', $vendor);

    }


    public function prettyPrint()
    {
        $doc = new \DomDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($this->build->asXML());
        $xmlString = $doc->saveXML();
        echo $xmlString;
    }

    public function strictBuildIssue()
    {
        if ($this->getTarget('build-issue') === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target build-issue em build.xml'));
        }
    }

    public function getTargetIndex($search)
    {
        $index = 0;
        foreach ($this->build as $targetInFile) {

            $name = (string) $targetInFile[0***REMOVED***->attributes()->name;
            if ($name === $search) {
                return $index;
            }
            $index = $index + 1;
        }

        return false;

    }

    public function addMissingUnitCI()
    {
        $cs = $this->build->addChild('target', '');
        $cs->addAttribute('name', 'unit-ci');
        $cs->addAttribute('depends', 'set-vendor');
        $cs->addAttribute('description', 'Run unit tests with Codeception For Continuous Integration');

        $css = $cs->addChild('exec', '');
        $css->addAttribute('executable', '${vendor}/bin/codecept');
        $css->addAttribute('failonerror', 'true');

        $arg1 = $css->addChild('arg', '');
        $arg1->addAttribute('value', 'run');

        $arg2 = $css->addChild('arg', '');
        $arg2->addAttribute('value', 'unit');

        $arg3 = $css->addChild('arg', '');
        $arg3->addAttribute('value', '--xml');

        $arg4 = $css->addChild('arg', '');
        $arg4->addAttribute('value', '--coverage-xml');

        $arg5 = $css->addChild('arg', '');
        $arg5->addAttribute('value', '--coverage-html');

    }

    public function addMissingParallelLint()
    {
        $cs = $this->build->addChild('target', '');
        $cs->addAttribute('name', 'parallel-lint');
        $cs->addAttribute('depends', 'set-vendor');
        $cs->addAttribute('description', 'Run PHP parallel lint For Continuous Integration');


        $css = $cs->addChild('exec', '');
        $css->addAttribute('executable', '${vendor}/bin/parallel-lint');
        $css->addAttribute('failonerror', 'true');

        $arg1 = $css->addChild('arg', '');
        $arg1->addAttribute('line', '--exclude');

        $arg2 = $css->addChild('arg', '');
        $arg2->addAttribute('path', '${basedir}/vendor');

        $arg3 = $css->addChild('arg', '');
        $arg3->addAttribute('path', '${basedir}');
    }

    public function buildParallelLint()
    {
        if (($parallellint = $this->getTargetIndex('parallel-lint')) === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target parallel-lint em build.xml'));
            $this->addMissingParallelLint();
            return;
        }

        $this->strictTarget($parallellint);
    }

    public function strictTarget($index)
    {
        $this->build->target[$index***REMOVED***->attributes()->depends = 'set-vendor';
        $exec = (string) $this->build->target[$index***REMOVED***->exec[0***REMOVED***->attributes()->executable;
        $exec2 = preg_replace('/.*bin/', '${vendor}/bin', $exec);
        $this->build->target[$index***REMOVED***->exec[0***REMOVED***->attributes()->executable = $exec2;
    }

    public function buildUnitCI()
    {
        if (($unit = $this->getTargetIndex('unit-ci')) === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target unit-ci em build.xml'));
            $this->addMissingUnitCI();
            return;
        }

        $this->strictTarget($unit);
    }

    public function createBuild()
    {
        $depends = 'prepare, set-vendor, parallel-lint, phpcs-ci, '
                 . 'phpmd-ci, phpcpd-ci, unit-ci, phploc-ci, pdepend, phpdox';

        $cs = $this->build->addChild('target', '');
        $cs->addAttribute('name', 'build');
        $cs->addAttribute('depends', $depends);
    }

    public function build()
    {
        $target = $this->getTargetIndex('build');


        if ($target === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target build em build.xml'));
            $this->createBuild();
            return;
        }

        $depends = 'prepare, set-vendor, parallel-lint, phpcs-ci, '
                 . 'phpmd-ci, phpcpd-ci, unit-ci, phploc-ci, pdepend, phpdox';

        if ((string) $this->build->target[$target***REMOVED***->attributes()->depends !== $depends) {
            $this->console->writeLine(sprintf('Gear irá corrigir o depends do target build em build.xml'));
            $this->build->target[$target***REMOVED***->attributes()->depends = $depends;
        }

        if ((string) $this->build->attributes()->default !== 'build') {
            $this->console->writeLine(sprintf('Gear irá corrigir a build default em build.xml'));
            $this->build->attributes()->default = 'build';
        }
    }

    public function strictBuild()
    {

        $this->build();


        if (($prepare = $this->getTargetIndex('prepare')) === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target prepare em build.xml'));
            die('missing prepare');
        }

        $this->buildParallelLint();


        if (($phpcs = $this->getTargetIndex('phpcs-ci')) === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target phpcs-ci em build.xml'));
            die('missing phpcs-ci');
        }

        $this->strictTarget($phpcs);

        if (($phpmd = $this->getTargetIndex('phpmd-ci')) === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target phpmd-ci em build.xml'));
            die('missing phpmd-ci');
        }

        $this->strictTarget($phpmd);

        if (($phpcpd = $this->getTargetIndex('phpcpd-ci')) === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target phpcpd-ci em build.xml'));
            die('missing phpcpd-ci');
        }

        $this->strictTarget($phpcpd);



        $this->buildUnitCI();


        if (($phploc = $this->getTargetIndex('phploc-ci')) === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target phploc-ci em build.xml'));
            die('missing phploc-ci');
        }

        $this->strictTarget($phploc);

        if (($pdepend = $this->getTargetIndex('pdepend')) === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target pdepend em build.xml'));
            die('missing pdepend');
        }

        $this->strictTarget($pdepend);

        if (($phpdox = $this->getTargetIndex('phpdox')) === false) {
            $this->console->writeLine(sprintf('Gear irá criar o target phpdox em build.xml'));
            die('missing phpdox');
        }

        $this->build->target[$phpdox***REMOVED***->attributes()->depends = 'set-vendor';

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


    public function upgrade()
    {
        $this->file = $this->module->getMainFolder().'/build.xml';


        $this->build = simplexml_load_file($this->file);


        $this->strictName();
        $this->strictSetVendor();

        $this->strictBuild();

        $this->strictBuildDev();
        $this->strictBuildFile();
       // $this->strictBuildIssue();
        //$this->prettyPrint();

        $this->persist();

        //var_dump((string) $this->build->attributes()->name);

        return;

    }

    public function strictBuildDev()
    {

    }

    public function strictBuildFile()
    {

    }

    public function create()
    {

    }

    public function update()
    {

    }
}
