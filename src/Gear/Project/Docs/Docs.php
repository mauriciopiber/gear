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

    public function createIndex($type = 'web')
    {

        $config = [
            'label' => $this->str('label', $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***),
        ***REMOVED***;

        $location = $this->getProject();

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/project/docs/index.phtml', $type));
        $file->setOptions($config);
        $file->setLocation($location);
        $file->setFileName('index.md');

        return $file->render();

    }

    public function createConfig()
    {
        $config = [
            'label' => $this->str('label', $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***),
            //'version' => $version
        ***REMOVED***;

        $location = $this->getProject();

        $file = $this->getFileCreator();
        $file->setTemplate('template/project/docs/mkdocs.phtml');
        $file->setOptions($config);
        $file->setLocation($location);
        $file->setFileName('mkdocs.yml');

        return $file->render();
    }

    public function createReadme()
    {
        //$version = '';

        $config = [
            'label' => $this->str('label', $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***),
            //'version' => $version
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
