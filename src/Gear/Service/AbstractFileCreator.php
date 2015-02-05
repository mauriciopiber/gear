<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\AbstractFixtureService;
use Zend\View\Model\ViewModel;
use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractFileCreator extends AbstractFixtureService
{

    protected $view;

    protected $configVars;

    protected $fileName;

    protected $location;

    protected $childView;

    public function render()
    {
        if (!$this->view) {
            throw new \Gear\Exception\FileCreator\ViewNotFoundException();
        }

        if (!$this->configVars) {
            throw new \Gear\Exception\FileCreator\ConfigNotFoundException();
        }

        if (!$this->fileName) {
            throw new \Gear\Exception\FileCreator\FileNameNotFoundException();
        }

        if (!$this->location) {
            throw new \Gear\Exception\FileCreator\LocationNotFoundException();
        }

        $view = $this->renderViewModel($this->getRenderView());
        return $this->getFileService()->factory($this->getLocation(), $this->getFileName(), $view);
    }

    public function renderViewModel($viewModel)
    {
        $viewModel->setOption('has_parent', true);

        $renderer = $this->getTemplateService()->getRenderer();

        if ($viewModel->hasChildren()) {
            foreach ($viewModel->getChildren() as $child) {
                if($viewModel->terminate() && $child->terminate()) {
                    throw new DomainException('Inconsistent state; child view model is marked as terminal');
                }
                $child->setOption('has_parent', true);
                $result = $this->renderViewModel($child);
                $child->setOption('has_parent', null);
                $capture = $child->captureTo();
                if (!empty($capture)) {
                    if ($child->isAppend()) {
                        $oldResult=$viewModel->{$capture};
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
        $viewModel = new ViewModel($this->getConfigVars());
        $viewModel->setTemplate($this->getView());

        if ($this->getChildView()->count() > 0) {

            foreach ($this->getChildView() as $i => $child) {

                $childViewModel = new ViewModel();
                $childViewModel->setTemplate($child['template'***REMOVED***);


                $viewModel->addChild($childViewModel, $child['placeholder'***REMOVED***);
            }
        }
        return $viewModel;
    }

    /**
     *
     * @param array $view -> template -> config -> placeholder
     */
    public function addChildView($view)
    {
        if (!$this->childView) {
            $this->childView = new ArrayCollection();
        }
        $this->childView->add($view);
    }

    public function getChildView()
    {
        return $this->childView;
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

    public function getConfigVars()
    {
        return $this->configVars;
    }

    public function setConfigVars($config)
    {
        $this->configVars = $config;
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
}