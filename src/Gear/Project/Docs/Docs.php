<?php
namespace Gear\Project\Docs;

use Gear\Service\AbstractJsonService;
use Gear\Project\ProjectLocationTrait;

class Docs extends AbstractJsonService
{
    use ProjectLocationTrait;

    public $config;

    public function __construct($config, $string, $file)
    {
        $this->config = $config;
        $this->stringService = $string;
        $this->fileCreator = $file;
    }

    public function createIndex($name = null, $location = null)
    {

        if ($name === null) {
            $name = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;
        }

        $label = $this->str('label', $name);

        if (is_dir($location)) {
            $this->setProject($location);
        }

        $config = [
            'label' => $label,
        ***REMOVED***;

        $location = $this->getProject().'/docs';

        if (!is_dir($location)) {
            mkdir($location);
        }

        $file = $this->getFileCreator();
        $file->setTemplate('template/project/docs/index.phtml');
        $file->setOptions($config);
        $file->setLocation($location);
        $file->setFileName('index.md');

        return $file->render();
    }

    public function createConfig($name = null, $location = null)
    {
        if ($name === null) {
            $name = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;
        }

        $label = $this->str('label', $name);

        if (is_dir($location)) {
            $this->setProject($location);
        }

        $config = [
            'label' => $label,
        ***REMOVED***;

        $location = $this->getProject();

        $file = $this->getFileCreator();
        $file->setTemplate('template/project/docs/mkdocs.phtml');
        $file->setOptions($config);
        $file->setLocation($location);
        $file->setFileName('mkdocs.yml');

        return $file->render();
    }

    public function createReadme($name = null, $location = null)
    {
        if ($name === null) {
            $name = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;
        }

        $label = $this->str('label', $name);

        if (is_dir($location)) {
            $this->setProject($location);
        }

        $config = [
            'label' => $label,
        ***REMOVED***;

        $location = $this->getProject();

        $file = $this->getFileCreator();
        $file->setTemplate('template/project/docs/readme.phtml');
        $file->setOptions($config);
        $file->setLocation($location);
        $file->setFileName('README.md');

        return $file->render();
    }
}
