<?php
namespace Gear\Autoload;

class Namespaces
{

    protected $autoloadFile;

    public function addNamespaceIntoComposer($namespace, $path)
    {
        $contents = $this->getAutoloaderContents();
        $lines = explode("\n", $contents);
        $count = count($lines)-2;
        unset($lines[$count***REMOVED***, $lines[$count+1***REMOVED***);
        $lines[***REMOVED*** = sprintf("    '%s' => array(\$baseDir . '%s'),", $namespace, $path);
        $lines[***REMOVED*** = sprintf(");");
        $lines[***REMOVED*** = sprintf("");
        $contents = implode("\n", $lines);

        return $contents;
    }

    public function deleteNamespaceFromComposer($namespace)
    {
        $contents = $this->getAutoloaderContents();

        $lines = explode("\n", $contents);
        $exclude = array();
        foreach ($lines as $line) {
            if (strpos($line, $namespace) !== FALSE) {
                continue;
            }
            $exclude[***REMOVED*** = $line;
        }
        $contents = implode("\n", $exclude);

        return $contents;
    }

    /**
     * Transforma o arquivo em String.
     */

    public function getAutoloaderContents()
    {
        return file_get_contents($this->getAutoloadFile());
    }

    public function getAutoloadFile()
    {
        if (!isset($this->autoloadFile)) {
            $this->autoloadFile = \GearBase\Module::getProjectFolder().'/vendor/composer/autoload_namespaces.php';
        }
        return $this->autoloadFile;
    }

    public function setAutoloadFile($autoloadFile)
    {
        $this->autoloadFile = $autoloadFile;
        return $this;
    }
}
