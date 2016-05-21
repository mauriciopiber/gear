<?php
namespace Gear\Diagnostic;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Symfony\Component\Yaml\Parser;

class ComposerService implements ServiceLocatorAwareInterface, ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    use ServiceLocatorAwareTrait;

    public function diagnosticProjectWeb()
    {



        return [***REMOVED***;
    }

    public function diagnosticModuleWeb()
    {
        $edge = __DIR__.'/../../../data/edge-technologic/module/web/composer.yml';

        if (!is_file($edge)) {
            throw new \Gear\Diagnostic\Exception\EdgeNotFound('Module Web');
        }

        $yaml = new Parser();


        $value = $yaml->parse(file_get_contents($edge));

        var_dump($value);


        return [***REMOVED***;
    }

    public function diagnosticModuleCli()
    {
        return [***REMOVED***;
    }
}
