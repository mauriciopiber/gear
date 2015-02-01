<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\AbstractJsonService;

abstract class AbstractFileCreator extends AbstractJsonService
{

    protected $template;

    protected $config;

    protected $fileName;

    protected $location;

    public function render()
    {
        if (!$this->template) {
            throw new \Gear\Exception\FileCreator\TemplateNotFoundException();
        }

        if (!$this->config) {
            throw new \Gear\Exception\FileCreator\ConfigNotFoundException();
        }

        if (!$this->fileName) {
            throw new \Gear\Exception\FileCreator\FileNameNotFoundException();
        }

        if (!$this->location) {
            throw new \Gear\Exception\FileCreator\LocationNotFoundException();
        }

        $template = $this->getTemplateService()->render($this->getTemplate(), $this->getConfig());
        return $this->getFileService()->factory($this->getLocation(), $this->getFileName(), $template);
    }



    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config)
    {
        $this->config = $config;
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