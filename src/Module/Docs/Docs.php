<?php
namespace Gear\Module\Docs;

use Gear\Service\AbstractJsonService;

class Docs extends AbstractJsonService
{

    public function __construct($module, $string, $file)
    {
        $this->module = $module;
        $this->stringService = $string;
        $this->fileCreator = $file;
    }

    public function createChangelog()
    {

        $config = [
            'label' => $this->str('label', $this->getModule()->getModuleName()),
        ***REMOVED***;

        $location = $this->getModule()->getDocsFolder();

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('docs-template/CHANGELOG.phtml'));
        $file->setOptions($config);
        $file->setLocation($location);
        $file->setFileName('CHANGELOG.md');

        return $file->render();
    }

    public function createIndex($type = 'web')
    {

        $config = [
            'label' => $this->str('label', $this->getModule()->getModuleName()),
        ***REMOVED***;

        $location = $this->getModule()->getDocsFolder();

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('docs-template/index-%s.phtml', $type));
        $file->setOptions($config);
        $file->setLocation($location);
        $file->setFileName('index.md');

        return $file->render();
    }

    public function createConfig()
    {
        $version = '';

        $config = [
            'label' => $this->str('label', $this->getModule()->getModuleName()),
            'version' => $version
        ***REMOVED***;

        $location = $this->getModule()->getMainFolder();

        $file = $this->getFileCreator();
        $file->setTemplate('docs-template/mkdocs.phtml');
        $file->setOptions($config);
        $file->setLocation($location);
        $file->setFileName('mkdocs.yml');

        return $file->render();
    }

    public function createReadme()
    {
        $version = '';

        $config = [
            'label' => $this->str('label', $this->getModule()->getModuleName()),
            'version' => $version
        ***REMOVED***;

        $location = $this->getModule()->getMainFolder();

        $file = $this->getFileCreator();
        $file->setTemplate('docs-template/readme.phtml');
        $file->setOptions($config);
        $file->setLocation($location);
        $file->setFileName('README.md');

        return $file->render();
    }
}
