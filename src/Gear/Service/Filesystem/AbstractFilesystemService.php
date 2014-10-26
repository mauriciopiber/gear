<?php
namespace Gear\Service\Filesystem;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Gear\Common\LogMessage;

class AbstractFilesystemService implements ServiceLocatorAwareInterface
{
    protected $console;

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;

    public function outputCreating($message)
    {
        if (!isset($this->console)) {
            $this->console = $this->getServiceLocator()->get('console');
        }

        $request =  $this->getServiceLocator()->get('Request');

        if ($request->getParam('verbose') || $request->getParam('v')) {
            return $this->console->writeLine($message, 0, LogMessage::CREATE_FILE);
        }
    }

    public function outputRemoving($message)
    {
        if (!isset($this->console)) {
            $this->console = $this->getServiceLocator()->get('console');
        }
        $request =  $this->getServiceLocator()->get('Request');

        if ($request->getParam('verbose') || $request->getParam('v')) {
            return $this->console->writeLine($message, 0, LogMessage::DROP_FILE);
        }
    }
}
