<?php
namespace Gear\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Console\Request;
use Gear\Common\LogMessage;
use Zend\Console\ColorInterface;

class Gear extends AbstractPlugin {

    protected $request;

    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function loopActivity($service, $data = array(), $serviceName = __FUNCITION__)
    {

        $result = null;


        $toDo   = $this->getRequest()->getParam('toDo', null);
        $moduleName  = $this->getRequest()->getParam('module', null);

        switch($toDo) {
        	case 'create':
        	    $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0, ColorInterface::GREEN);
        	    $result = $service->create($data);
        	    break;
        	case 'delete':
        	    $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::DESTROY), 0, ColorInterface::GREEN);
        	    $result = $service->delete($data);
        	    break;
        	case 'setUpGlobal':
        	    $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0,  ColorInterface::GREEN);
        	    $result = $service->setUpGlobal($data);
        	    break;
        	case 'setUpLocal':
        	    $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0, ColorInterface::GREEN);
        	    $result = $service->setUpLocal($data);
        	    break;
        	case 'setUpEnvironment':
        	    $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0, ColorInterface::GREEN);
        	    $result = $service->setUpEnvironment($data);
        	    break;
        	case 'build':
        	    $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0, ColorInterface::GREEN);
        	    $result = $service->build($data);
        	    break;
    	    case 'load':
    	        $serviceName = 'Load';

    	        $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0, ColorInterface::GREEN);
    	        $result = $service->load();
    	        break;
	        case 'unload':
	            $serviceName = 'Unload';
	            $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::GEARING), 0, ColorInterface::GREEN);
	            $result = $service->unload();
	            break;
        }
        $this->loopResult($service, $result, $serviceName, true);
        return $result;
    }

    public function loopResult($service, $element, $serviceName, $destroy = false)
    {
        $moduleName  = $this->getRequest()->getParam('module', null);
        if ($element) {
            $code = LogMessage::OK_CODE;
            $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::OK), 0, $code);
        } else {
            $code = ColorInterface::BLUE;
            $service->output(sprintf('%s [%s***REMOVED*** %s', $moduleName, $serviceName, LogMessage::FAIL), 0,  $code);
        }
    }


}
