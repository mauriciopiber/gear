<?php
namespace Gear\Creator;

use Doctrine\Common\Collections\ArrayCollection;
use Zend\View\Model\ViewModel;

class File
{

    protected $view;

    protected $options;

    protected $fileName;

    protected $location;

    protected $childView;

    protected $fileService;

    protected $templateService;

    public function __construct($fileService, $templateService)
    {
        $this->fileService = $fileService;
        $this->templateService = $templateService;
    }

    public static function arrayToFile($file, $array)
    {
        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($array, true));
        $dataArray = str_replace('\\\\', '\\', $dataArray);
        $dataArray = implode("\n", array_map('rtrim', explode("\n", $dataArray)));
        file_put_contents($file, '<?php return ' . $dataArray . ';'.PHP_EOL);
        return true;
    }

    public function createFile($template, $options, $fileName, $location)
    {
        $this->view = $template;
        $this->options  = $options;
        $this->fileName = $fileName;
        $this->location = $location;
        return $this->render();
    }

    public function render()
    {
        if (! $this->view) {
            throw new \Gear\Exception\FileCreator\ViewNotFoundException();
        }

        if (! $this->options) {
            $this->options = [***REMOVED***;
        }

        if (! $this->fileName) {
            throw new \Gear\Exception\FileCreator\FileNameNotFoundException();
        }

        if (! $this->location) {
            throw new \Gear\Exception\FileCreator\LocationNotFoundException();
        }

        $view = $this->renderViewModel($this->getRenderView());
        return $this->fileService->factory($this->getLocation(), $this->getFileName(), $view);
    }

    public function renderTemplate()
    {
        return $this->renderViewModel($this->getRenderView());
    }

    public function debug()
    {
        echo $this->renderViewModel($this->getRenderView());
    }

    public function renderViewModel($viewModel)
    {
        $viewModel->setOption('has_parent', true);

        $renderer = $this->templateService->getRenderer();

        if ($viewModel->hasChildren()) {
            foreach ($viewModel->getChildren() as $child) {
                if ($viewModel->terminate() && $child->terminate()) {
                    throw new DomainException('Inconsistent state; child view model is marked as terminal');
                }
                $child->setOption('has_parent', true);
                $result = $this->renderViewModel($child);
                $child->setOption('has_parent', null);
                $capture = $child->captureTo();
                if (! empty($capture)) {
                    if ($child->isAppend()) {
                        $oldResult = $viewModel->{$capture};
                        $viewModel->setVariable($capture, $oldResult . $result);
                    } else {
                        $viewModel->setVariable($capture, $result);
                    }
                }
            }
        }

        $html = $renderer->render($viewModel);
        return $html;
    }

    public function getRenderView()
    {
        $viewModel = new ViewModel($this->getOptions());
        $viewModel->setTemplate($this->getView());


        if ($this->getChildView() !== null && $this->getChildView()->count() > 0) {

            foreach ($this->getChildView() as $i => $child) {

                $childViewModel = new ViewModel($child['config'***REMOVED***);
                $childViewModel->setTemplate($child['template'***REMOVED***);

                $viewModel->addChild($childViewModel, $child['placeholder'***REMOVED***);
            }
        }
        return $viewModel;
    }

    /**
     *
     * @param array $view
     *            -> template -> config -> placeholder
     */
    public function addChildView($view)
    {
        if (! $this->childView) {
            $this->childView = new ArrayCollection();
        }
        $this->childView->add($view);
    }

    public function getChildView()
    {
        return $this->childView;
    }

    public function setTemplate($template)
    {
        $this->view = $template;
        return $this;
    }

    public function getView()
    {
        return $this->view;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($config)
    {
        $this->options = $config;
        return $this;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    public function getFileService()
    {
        return $this->fileService;
    }

    public function setFileService($fileService)
    {
        $this->fileService = $fileService;
        return $this;
    }

    public function getTemplateService()
    {
        return $this->templateService;
    }

    public function setTemplateService($templateService)
    {
        $this->templateService = $templateService;
        return $this;
    }
}
