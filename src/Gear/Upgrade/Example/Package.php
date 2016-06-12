<?php
namespace Gear\Project\Upgrade;

use Zend\ServiceManager\ServiceManager;
use Zend\Console\Prompt;
use Gear\Project\Upgrade\UpgradeInterface;

class Package extends AbstractUpgrade implements UpgradeInterface
{
    public function __construct(ServiceManager $serviceLocator)
    {
        $this->git             = $serviceLocator->get('config')['gear'***REMOVED***['git'***REMOVED***;
        $this->project         = $serviceLocator->get('config')['gear'***REMOVED***['name'***REMOVED***;
        $this->fileService     = $serviceLocator->get('fileService');
        $this->templateService = $serviceLocator->get('templateService');
        $this->templateFile    = 'template/project/package.json.phtml';
        $this->realFilePath    = \GearBase\Module::getProjectFolder().'/package.json';
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
        $file->setOptions(['git' => $this->git, 'project' => $this->project***REMOVED***);
        $file->setFileName('package.json');
        $file->setLocation(\GearBase\Module::getProjectFolder());

        return $file->render();
    }


    public function update()
    {
        $file = new \Gear\Creator\File(
            $this->fileService,
            $this->templateService
        );

        $file->setTemplate($this->templateFile);
        $file->setOptions(['git' => $this->git, 'project' => $this->project***REMOVED***);

        $this->template = $file->renderTemplate();

        if ($this->template !== $this->realFile) {
            if ($this->request->getParam('Y', false) == false) {
                $this->showCompare();

                $confirm = new Prompt\Confirm('Deseja atualizar o arquivo package.json? Y/N');
                $result = $confirm->show();
                if ($result !== true) {
                    return;
                }
            }

            file_put_contents($this->realFilePath, $this->template);

            $this->console->writeLine(
                sprintf(
                    '%s package.json foi criado na última versão.',
                    (new \DateTime('now'))->format('d/m/Y H:i:s')
                ),
                8,
                1
            );
        }

        $this->console->writeLine(
            sprintf(
                '%s package.json está atualizado na última versão.',
                (new \DateTime('now'))->format('d/m/Y H:i:s')
            ),
            8,
            1
        );

        return;
    }
}
