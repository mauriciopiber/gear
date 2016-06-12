<?php
namespace Gear\Module\Upgrade;

use Gear\Project\Upgrade\UpgradeInterface;
use Gear\Project\Upgrade\AbstractUpgrade;
use Zend\ServiceManager\ServiceManager;

class Composer extends AbstractUpgrade implements UpgradeInterface
{
    protected static $phpcpd      = '^2.0.2';
    protected static $phpcs       = '^2.0.0';
    protected static $phpunit     = '^4.8.19';
    protected static $codeception = '^2.1.4';
    protected static $phplint     = '^0.9';
    protected static $phpmd       = '^2.3.2';
    protected static $pdepend     = '^2.0.3';
    protected static $phploc      = '^2.1.5';
    protected static $phpdcd      = '^1.0.2';

    protected static $zendframework = '^2.5.1';

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
        $expected = 'mauriciopiber/'.$this->str->str('url', $this->module->getModuleName());

        if (!isset($this->composer['name'***REMOVED***) || $this->composer['name'***REMOVED*** !== $expected) {
            $this->console->writeLine('Gear irá ajustar o nome para você. '.$expected);
            $this->composer['name'***REMOVED*** = $expected;
            return;
        }
    }

    public function strictZendFramework()
    {
        if (!isset($this->composer['require'***REMOVED***['zendframework/zendframework'***REMOVED***)
            || $this->composer['require'***REMOVED***['zendframework/zendframework'***REMOVED*** !== static::$zendframework
        ) {
            $this->console->writeLine(sprintf('Gear irá arrumar o require zendframework/zendframework pra você. '));
            $this->composer['require'***REMOVED***['zendframework/zendframework'***REMOVED*** = static::$zendframework;
        }
    }


    public function strictCiRequiredDev()
    {
        $required = [
            "sebastian/phpcpd" => static::$phpcpd,
            "sebastian/phpdcd" => static::$phpdcd,
            "phpunit/phpunit" => static::$phpunit,
            "phploc/phploc" => static::$phploc,
            "codeception/codeception" => static::$codeception,
            "squizlabs/php_codesniffer" => static::$phpcs,
            "phpmd/phpmd" => static::$phpmd,
            "jakub-onderka/php-parallel-lint" => static::$phplint,
            "pdepend/pdepend" => static::$pdepend
        ***REMOVED***;

        foreach ($required as $packageName => $packageVersion) {
            if (!isset($this->composer['require-dev'***REMOVED***[$packageName***REMOVED***)
                || $this->composer['require-dev'***REMOVED***[$packageName***REMOVED*** !== $packageVersion
            ) {
                $this->console->writeLine(sprintf('Gear irá arrumar o require dev %s para você. ', $packageName));
                $this->composer['require-dev'***REMOVED***[$packageName***REMOVED*** = $packageVersion;
            }
        }
    }

    public function strictRepository($packageName)
    {
        if ($this->composer['repositories'***REMOVED***[0***REMOVED***['url'***REMOVED*** === 'http://mirror.pibernetwork.com') {
            return;
        }

        foreach ($this->composer['repositories'***REMOVED*** as $repository) {
            if ($repository['url'***REMOVED*** === sprintf('git@bitbucket.org:%s.git', $packageName)) {
                return;
            }
        }
        $this->console->writeLine(sprintf('Gear irá arrumar o repositório %s para você. ', $packageName));
        $this->composer['repositories'***REMOVED***[***REMOVED*** = [
            'type' => 'vcs',
            'url' => sprintf('git@bitbucket.org:%s.git', $packageName)
        ***REMOVED***;
    }

    public function strictGear()
    {
        foreach ($this->composer['require'***REMOVED*** as $package => $version) {
            if (strpos($package, 'mauriciopiber/gear') !== false) {
                $this->strictRepository($package);

                if ($version !== '^0.2.0') {
                    $this->console->writeLine(sprintf('Gear irá arrumar o require %s para você. ', $package));
                    $this->composer['require'***REMOVED***[$package***REMOVED*** = '^0.2.0';
                }
            }
        }

        foreach ($this->composer['require-dev'***REMOVED*** as $package => $version) {
            if (strpos($package, 'mauriciopiber/gear') !== false) {
                $this->strictRepository($package);
                if ($version !== '^0.2.0') {
                    $this->console->writeLine(sprintf('Gear irá arrumar o require %s para você. ', $package));
                    $this->composer['require'***REMOVED***[$package***REMOVED*** = '^0.2.0';
                }
            }
        }
    }

    public function strictAutoload()
    {
        if (!isset($this->composer['autoload'***REMOVED***['psr-0'***REMOVED***[$this->module->getModuleName()***REMOVED***)
            || ($this->composer['autoload'***REMOVED***['psr-0'***REMOVED***[$this->module->getModuleName()***REMOVED*** !== 'src')
        ) {
            $this->console->writeLine(
                sprintf('Gear irá arrumar o autoload namespace %s para você. ', $this->module->getModuleName())
            );
            $this->composer['autoload'***REMOVED***['psr-0'***REMOVED***[$this->module->getModuleName()***REMOVED*** = 'src';
        }

        if (!isset($this->composer['autoload'***REMOVED***['psr-0'***REMOVED***[$this->module->getModuleName().'Test'***REMOVED***)
            || ($this->composer['autoload'***REMOVED***['psr-0'***REMOVED***[$this->module->getModuleName().'Test'***REMOVED*** !== 'test/unit')
        ) {
            $this->console->writeLine(
                sprintf('Gear irá arrumar o autoload namespace %s para você. ', $this->module->getModuleName().'Test')
            );
            $this->composer['autoload'***REMOVED***['psr-0'***REMOVED***[$this->module->getModuleName().'Test'***REMOVED*** = 'test/unit';
        }
    }

    public function strictVendor()
    {
        if (isset($this->composer['config'***REMOVED***) && isset($this->composer['config'***REMOVED***['vendor-dir'***REMOVED***)) {
            $this->console->writeLine(sprintf('Gear irá remover o config vendor-dir para você. '));
            unset($this->composer['config'***REMOVED***['vendor-dir'***REMOVED***);

            if (empty($this->composer['config'***REMOVED***)) {
                unset($this->composer['config'***REMOVED***);
            }
        }
    }

    public function upgrade()
    {
        $file = $this->module->getMainFolder().'/composer.json';

        $this->composer = \Zend\Json\Json::decode(file_get_contents($file), 1);

        $this->strictName();
        $this->strictCiRequiredDev();
        $this->strictZendFramework();
        $this->strictGear();
        $this->strictAutoload();
        $this->strictVendor();

        $json = str_replace('\/', '/', json_encode($this->composer, JSON_UNESCAPED_UNICODE));
        file_put_contents($file, \Zend\Json\Json::prettyPrint($json, 1));
    }
}
