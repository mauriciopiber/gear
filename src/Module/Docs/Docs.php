<?php
namespace Gear\Module\Docs;

use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;

class Docs
{
    use FileCreatorTrait;

    use StringServiceTrait;

    use ModuleStructureTrait;

    public function __construct(
        ModuleStructure $module,
        StringService $string,
        FileCreator $file
    ) {
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
        $file->setTemplate(sprintf('template/module/docs/CHANGELOG.phtml'));
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
        $file->setTemplate(sprintf('template/module/docs/index-%s.phtml', $type));
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
        $file->setTemplate('template/module/docs/mkdocs.phtml');
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
        $file->setTemplate('template/module/docs/readme.phtml');
        $file->setOptions($config);
        $file->setLocation($location);
        $file->setFileName('README.md');

        return $file->render();
    }
}
