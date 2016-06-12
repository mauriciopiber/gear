<?php
namespace Gear\Project\Upgrade;

use Zend\ServiceManager\ServiceManager;
use Zend\Console\Prompt;
use Gear\Project\Upgrade\UpgradeInterface;

class Gulp extends AbstractUpgrade implements UpgradeInterface
{
    public function __construct(ServiceManager $serviceLocator)
    {
        $this->fileService     = $serviceLocator->get('fileService');
        $this->dirService      = $serviceLocator->get('dirService');
        $this->templateService = $serviceLocator->get('templateService');
        $this->templateFile    = 'template/project/gulpfile.js.phtml';
        $this->realFilePath    = \GearBase\Module::getProjectFolder().'/gulpfile.js';

        $this->gulpFolder = \GearBase\Module::getProjectFolder().'/gulp';
        $this->tasksFolder = $this->gulpFolder.'/tasks';

        parent::__construct($serviceLocator);
    }

    public function upgrade()
    {
        $this->realFile = $this->getRealFile();

        if ($this->realFile === false) {
            $this->create();
            return;
        }
        $this->update();
        return;
    }

    public function create()
    {
        $file = new \Gear\Creator\File(
            $this->fileService,
            $this->templateService
        );

        $file->setTemplate($this->templateFile);
        $file->setFileName('gulpfile.js');
        $file->setLocation(\GearBase\Module::getProjectFolder());

        $file->render();

        $this->createTaskFolder();


    }

    public function update()
    {

        if (!is_dir($this->tasksFolder)
            || !is_file($this->tasksFolder.'/file-js.js')
            || !is_file($this->tasksFolder.'/file-php.js')
            || !is_file($this->tasksFolder.'/module-js.js')
            || !is_file($this->tasksFolder.'/module-php.js')
        ) {
            $this->createTaskFolder();
        }



        $file = new \Gear\Creator\File(
            $this->fileService,
            $this->templateService
        );

        $file->setTemplate($this->templateFile);
        $this->template = $file->renderTemplate();

        if ($this->template !== $this->realFile) {
            if ($this->request->getParam('Y', false) == false) {
                $this->showCompare();

                $confirm = new Prompt\Confirm('Deseja atualizar o arquivo gulpfile.js? Y/N');
                $result = $confirm->show();
                if ($result !== true) {
                    return;
                }
            }

            file_put_contents($this->realFilePath, $this->template);

            $this->console->writeLine(
                sprintf(
                    '%s gulpfile.js foi criado na última versão.',
                    (new \DateTime('now'))->format('d/m/Y H:i:s')
                ),
                8,
                1
            );
        }

        $this->console->writeLine(
            sprintf(
                '%s gulpfile.js está atualizado na última versão.',
                (new \DateTime('now'))->format('d/m/Y H:i:s')
            ),
            8,
            1
        );

        return;


    }

    public function createTaskFolder()
    {
        $this->dirService->mkDir($this->gulpFolder);
        $this->dirService->mkDir($this->tasksFolder);
        $this->dirService->xcopy(__DIR__.'/../../../../view/template/project/gulp-tasks/tasks', $this->tasksFolder);
    }
}
