<?php
namespace Gear\Diagnostic\Ant;

use Gear\Service\AbstractJsonService;
use Gear\Project\ProjectLocationTrait;
use Gear\Edge\AntEdge\AntEdgeTrait;
use Gear\Diagnostic\ModuleDiagnosticInterface;
use Gear\Diagnostic\ProjectDiagnosticInterface;
use SimpleXmlElement;
use Gear\Edge\AntEdge\Exception\MissingTarget;
use Gear\Edge\AntEdge\Exception\MissingDefault;
use Gear\Edge\AntEdge\Exception\MissingImport;
use Gear\Edge\AntEdge\Exception\MissingFiles;
use GearBase\Config\GearConfigTrait;
use GearBase\Config\GearConfig;
use Exception;

/**
 * Executar as verificações/diagnósticos para módulos e projetos no arquivo build.xml.
 */
class AntService extends AbstractJsonService implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    public $errors;

    static public $missingTarget = 'Ant - Está faltando target "%s" no arquivo %s';

    static public $missingTargetDepend = 'Ant - Está faltando target "%s" com depends "%s" no arquivo %s';

    static public $missingDepends = 'Ant - Corrigir depends do Target "%s" para "%s" no arquivo %s';

    static public $missingName = 'Ant - Está faltando o nome %s no arquivo %s';

    public $build;

    const MISSING_FILE = 'Ant - Está faltando o arquivo %s';

    const MISSING_IMPORT = 'Ant - Está faltando o import %s';

    use ProjectLocationTrait;

    use AntEdgeTrait;

    use GearConfigTrait;

    public function __construct($stringService, $module = null, GearConfig $gearConfig)
    {
        $this->errors = [***REMOVED***;
        $this->stringService = $stringService;
        $this->module = $module;
        $this->gearConfig = $gearConfig;

    }

    public function diagnosticProject($type = 'web')
    {
        $edge = $this->getAntEdge()->getAntProject($type);

        $this->diagnosticEdge($edge);

        $build = $this->getProject();

        return $this->diagnostic($build, $edge, __FUNCTION__);
    }

    /**
     * Rodar diagnóstico da build.xml para Módulo
     */
    public function diagnosticModule($type = 'web')
    {
        $edge = $this->getAntEdge()->getAntModule($type);

        $this->diagnosticEdge($edge);

        $build = $this->module->getMainFolder();

        return $this->diagnostic($build, $edge, __FUNCTION__);
    }

    public function diagnosticEdge($edge)
    {
        if (!isset($edge['target'***REMOVED***) || !is_array($edge['target'***REMOVED***)) {
            throw new MissingTarget();
        }

        if (!isset($edge['default'***REMOVED***) || empty($edge['default'***REMOVED***)) {
            throw new MissingDefault();
        }

        if (isset($edge['import'***REMOVED***) && !is_array($edge['import'***REMOVED***)) {
            throw new MissingImport();
        }

        if (isset($edge['files'***REMOVED***) && !is_array($edge['files'***REMOVED***)) {
            throw new MissingFiles();
        }
    }



    public function getBuildFiles()
    {

    }

    public function getImports(SimpleXmlElement $build, $edge)
    {
        $errors = [***REMOVED***;

        foreach ($edge as $name) {

            $isPresent = $this->hasImport($build, sprintf('./test/%s.xml', $name));

            if ($isPresent === false) {
                $errors[***REMOVED*** = sprintf(self::MISSING_IMPORT, $name);
            }
        }



        return $errors;
    }

    public function getNames($base, array $edge)
    {
        $errors = [***REMOVED***;

        $name = $this->getGearConfig()->getCurrentName();

        if (!$this->hasName($this->build, $name)) {
            $errors[***REMOVED*** = sprintf(static::$missingName, $name, 'build.xml');
        }

        if (!isset($edge['files'***REMOVED***) || empty($edge['files'***REMOVED***)) {
            return $errors;
        }

        foreach ($edge['files'***REMOVED*** as $fileName => $config) {
            $config = null;

            if (!is_file(sprintf($base.'/test/%s.xml', $fileName))) {
                throw new Exception('File Not Found');
            }

            $string = file_get_contents(sprintf($base.'/test/%s.xml', $fileName));

            if (empty($string)) {
                throw new Exception('Empty XML');
            }

            $build = simplexml_load_string($string);

            $matches = array();
            preg_match('/ant-([a-z***REMOVED***+)/', $fileName, $matches);

            $hasName = sprintf('%s-%s', $name, $matches[1***REMOVED***);

            if (!$this->hasName($build, $hasName)) {
                $errors[***REMOVED*** = sprintf(static::$missingName, $hasName, sprintf('test/%s.xml', $fileName));
            }
        }

        return $errors;
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

    public function diagnostic($build, $edge, $function = null)
    {
        if (!is_file($build.'/build.xml')) {
            $this->errors[***REMOVED*** = sprintf(self::MISSING_FILE, 'build.xml');
        }

        if (isset($edge['files'***REMOVED***) && !empty($edge['files'***REMOVED***)) {

            foreach ($edge['files'***REMOVED*** as $expectedFile => $targets) {

                if (strpos($expectedFile, 'ant-') === false) {
                    continue;
                }

                if (!is_file($build . '/test/'.$expectedFile.'.xml')) {
                    $this->errors[***REMOVED*** = sprintf(self::MISSING_FILE, 'test/'.$expectedFile.'.xml');
                }
            }
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        }

        $this->build = simplexml_load_file($build.'/build.xml');

        if (isset($edge['import'***REMOVED***) && !empty($edge['import'***REMOVED***)) {
            $this->errors = $this->getImports($this->build, $edge['import'***REMOVED***);
        }



        if (count($this->errors) > 0) {
            return $this->errors;
        }

        $this->errors = $this->getNames($build, $edge);


        if (count($edge['target'***REMOVED***)>0) {
            $this->checkTargetFile($this->build, $edge['target'***REMOVED***, 'build.xml');
        }

        if (empty($edge['files'***REMOVED***) || !is_array($edge['files'***REMOVED***)) {
            return $this->errors;
        }

        $this->import = $this->getImport($build, $edge);

        if (!empty($this->import)) {

            foreach ($this->import as $name => $build) {

                if (!isset($edge['files'***REMOVED***[$name***REMOVED***) || empty($edge['files'***REMOVED***[$name***REMOVED***)) {
                    continue;
                }

                $this->checkTargetFile($build, $edge['files'***REMOVED***[$name***REMOVED***, sprintf('test/%s.xml', $name));
            }
        }

        return $this->errors;
    }

    public function checkTargetFile(SimpleXmlElement $build, $targets, $name)
    {
        foreach ($targets as $target => $dependency) {
             $this->checkTarget($build, $target, $dependency, $name);
        }
    }

    /**
     * Verifica se um determinado target existe no arquivo build, se não existe incrementa os erros.
     */
    public function checkTarget($build, $targetName, $depend = '', $file)
    {
        if (!$this->hasTarget($build, $targetName)) {

            $this->errors[***REMOVED*** = (empty($depend))
                ? sprintf(static::$missingTarget, $targetName, $file)
                : sprintf(static::$missingTargetDepend, $targetName, (is_array($depend)) ? implode(' ', $depend) : $depend, $file);

            return;
        }

        if (!$this->hasDepend($build, $targetName, $depend)) {
            $this->errors[***REMOVED*** = sprintf(static::$missingDepends, $targetName, $depend, $file);
        }

        return;
    }

    /**
     * Verifica se o Target tem a dependência exigida corretamente.
     */
    public function hasDepend(SimpleXmlElement $build, $targetName, $depend)
    {
        foreach ($build[0***REMOVED***->target as $target) {
            $name = (string) $target[0***REMOVED***->attributes()->name;

            if ($name === $targetName) {
                if ($depend === (string) $target[0***REMOVED***->attributes()->depends[0***REMOVED***) {
                    return true;
                }
                continue;
            }
        }

        return false;
    }

    public function hasImport($build, $search)
    {
        foreach ($build[0***REMOVED***->import as $target) {
            $name = (string) $target[0***REMOVED***->attributes()->file;
            if ($name === $search) {
                return true;
            }
        }

        return false;
    }

    /**
     * Verificar se há determinado Target no arquivo build.xml
     * @param string $search Nome do Target.
     * @return boolean
     */
    public function hasTarget($build, $search)
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
     * Verificar se o nome está respeitando o nome do módulo
     * @return boolean
     */
    public function hasName(SimpleXmlElement $build, $name)
    {
        if ((string) $build->attributes()->name
            === $this->getStringService()->str('url', $name)
        ) {
            return true;
        }

        return false;
    }
}
