<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Gear\Constructor\ValueObject\Controller;
use Gear\ValueObject\Test;

class TestService extends AbstractJsonService
{
    const ACCEPTANCE = 'template/test/acceptance/single.phtml';
    const FUNCTIONAL = 'template/test/functional/single.phtml';
    const UNIT       = 'template/test/unit/single.phtml';

    public function isValid($data)
    {
        $invalids = [***REMOVED***;

        $validator = new \Zend\Validator\InArray(array('haystack' => array('acceptance', 'functional', 'unit')));
        if (!$validator->isValid($data['suite'***REMOVED***)) {
            $invalids[***REMOVED*** = $validator->getMessages();
        }

        $validator = new \Zend\Validator\NotEmpty();
        if (!$validator->isValid($data['target'***REMOVED***)) {
            $invalids[***REMOVED*** = $validator->getMessages();
        }


        return (count($invalids) > 0) ? $invalids : true;
    }

    public function create($data = array())
    {

        if ($this->isValid($data) === true) {

            $test = new Test($data);
            $test->prepare($this->getModule()->getModuleName());

            $this->getDirService()->mkDeepDir($test->getTarget(), $test->getTestFolder().'/'.$test->getSuite());

            $this->createFileFromTemplate(
                $this->getTemplateName($test->getSuite()),
                $this->getTemplateConfig($test),
                $test->getFileName(),
                $test->getFileLocation()
            );

            return true;

        } else {
            return false;
        }
    }

    public function getTemplateName($switch)
    {
        $template = '';
        switch ($switch) {
            case 'acceptance':
                $template = self::ACCEPTANCE;
                break;

            case 'functional':
                $template = self::FUNCTIONAL;
                break;

            case 'unit':
                $template = self::UNIT;
                break;

            default:
                $template = false;
                break;

        }
        return $template;
    }

    public function getTemplateConfig($switch)
    {
        $template = '';
        switch ($switch->getSuite()) {
            case 'acceptance':
            case 'functional':
                $template = array();
                break;
            case 'unit':
                $template = array(
                    'namespace' => $switch->getNamespace()
                );
                break;

            default:
                $template = false;
                break;

        }
        $template = array_merge(array(
            'module' => $this->getModule()->getModuleName(),
            'targetName' => $switch->getFileNameToClass(),
        ), $template);

        return $template;
    }

    public function delete($data = array())
    {
        return true;
    }
}
