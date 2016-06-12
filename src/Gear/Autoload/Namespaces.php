<?php
namespace Gear\Autoload;

class Namespaces
{
    protected $autoloadFile;

    protected $contents;

    public function addNamespaceIntoComposer($namespace, $path)
    {
        if (!isset($this->contents)) {
            $this->contents = $this->getAutoloaderContents();
        }

        $lines = explode("\n", $this->contents);
        $count = count($lines) - 2;
        unset($lines[$count***REMOVED***, $lines[$count + 1***REMOVED***);
        $lines[***REMOVED*** = sprintf("    '%s' => array(\$baseDir . '%s'),", $namespace, $path);
        $lines[***REMOVED*** = sprintf(");");
        $lines[***REMOVED*** = sprintf("");
        $this->contents = implode("\n", $lines);


        return $this;
    }


    public function extractContents()
    {
        $this->contents = $this->getAutoloaderContents();
        return $this;
    }

    public function write()
    {
        return file_put_contents($this->autoloadFile, $this->contents);
    }

    public function deleteNamespaceFromComposer($namespace)
    {
        if (!isset($this->contents)) {
            $this->contents = $this->getAutoloaderContents();
        }


        $lines = explode("\n", $this->contents);
        $exclude = array();
        foreach ($lines as $line) {
            if (strpos($line, $namespace) !== false) {
                continue;
            }
            $exclude[***REMOVED*** = $line;
        }


        $this->contents = implode("\n", $exclude);

        return $this;
    }


    public function checkNamespaceExists($namespace)
    {
        if (empty($this->contents)) {
            $this->extractContents();
        }

        if (strpos($this->contents, $namespace) !== false) {
            return true;
        }

        return false;
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
        if (! isset($this->autoloadFile)) {
            $this->autoloadFile = \GearBase\Module::getProjectFolder() . '/vendor/composer/autoload_namespaces.php';
        }
        return $this->autoloadFile;
    }

    public function setAutoloadFile($autoloadFile)
    {
        $this->autoloadFile = $autoloadFile;
        return $this;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function setContents($contents)
    {
        $this->contents = $contents;
        return $this;
    }
}
