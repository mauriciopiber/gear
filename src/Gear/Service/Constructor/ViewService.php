<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Gear\Constructor\ValueObject\Controller;

class ViewService extends AbstractJsonService
{
    const TOP = 'template/view/single.view.phtml';

    public function isValid($data)
    {
        if (!isset($data['target'***REMOVED***)) {
            return false;
        }

        $invalid = [***REMOVED***;

        $dirValidator = new \Gear\Validator\DirValidator();
        $valid = $dirValidator->isValid($data['target'***REMOVED***);

        if (!$valid) {
            $invalid[***REMOVED*** = $valid;
        }

        return $valid;
    }

    public function create($data = array())
    {
        if ($this->isValid($data) !== false) {

            $view = new \Gear\ValueObject\View($data);
            $view->prepare($this->getConfig()->getModule());

            $this->getDirService()->mkDeepDir($view->getTarget(), $view->getViewFolder());

            $this->createFileFromTemplate(
                self::TOP,
                array(),
                $view->getFileName(),
                $view->getFileLocation()
            );
            return true;
        } else {
            //adicionar logs do erro;
            return false;
        }
    }

    public function delete($data = array())
    {
        return true;
    }
}
