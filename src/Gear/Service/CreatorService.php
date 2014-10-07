<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável primeiramente pela geração das classes abstratas e das classes virgens do sistema.
 */
namespace Gear\Service;

class CreatorService extends AbstractService
{
    protected $message = array();

    public function factory($mod, $srcType, $options)
    {
        $service = sprintf('%sService', $srcType);

        $factoryService = $this->getServiceLocator()->get($service);
        $metaService    = $this->getServiceLocator()->get('jsonService');

        if (in_array($mod, array('new', 'add', 'create'))) {
            $factory = $factoryService->create($options);
            $metaService->insertIntoJson($factory);
        } elseif (in_array($mod, array('delete', 'remove', 'del'))) {
            $factory = $factoryService->delete($options);
        } else {
            $factory = $factoryService->getAbstract($options);
        }

        return 'Factory sucessfully'."\n";
    }

    public function isValid()
    {
        $valid = true;
        if (!is_file($this->getConfig()->getModuleConfigFile())) {
            $this->addMessage(sprintf('File module.config.php wasn\'t set for %s', $this->getConfig()->getModule()));
            $valid = false;
        }

        if (!is_dir($this->getConfig()->getModuleFolder())) {
            $this->addMessage(sprintf('Module Folder wasn\'t set for %s', $this->getConfig()->getModule()));
            $valid = false;
        }

        if (!is_file($this->getConfig()->getModuleFile())) {
            $this->addMessage(sprintf('File Module.php wasn\'t set for %s', $this->getConfig()->getModule()));
            $valid = false;
        }

        return $valid;
    }

    public function src($mod, $srcType, $options)
    {

        if (!in_array($mod, $this->getAvailableMods())) {
            return sprintf("Mod %s is not allowed\n", $mod);
        } else {
            $action = sprintf('Preparing console to use %s ', $mod);
        }

        if (!in_array($srcType, $this->getAvailableSrc())) {
            return sprintf("Src %s is not allowed to manager\n", $srcType);
        } else {
            $action .= sprintf('for %s', $srcType)."\n";
        }

        echo $action."\n";

        return $this->factory($mod, $srcType, $options);

    }

    public function getMessage()
    {
        return implode("\n", $this->message)."\n";
    }

    public function addMessage($message)
    {
        $this->message[***REMOVED*** = $message;
    }

    public function getAvailableMods()
    {
        return array(
            'new',
            'add',
            'create',
            'delete',
            'remove',
            'del'
        );
    }

    public function getAvailableSrc()
    {
        return array(
            'service',
            'repository',
            'entity',
            'factory',
            'valueObject',
            'controller',
            'form',
            'filter',
            'controllerPlugin',
        );
    }
}
