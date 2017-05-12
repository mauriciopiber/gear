<?php
namespace Gear\Creator\Codes\Code;

use Gear\Creator\Codes\AbstractCodeBase;
use Gear\Creator\ClassObject;
use GearJson\Src\Src;
use GearJson\Controller\Controller;
use GearJson\App\App;
use GearJson\Db\Db;


/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Creator/Codes/Code
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
abstract class AbstractCode extends AbstractCodeBase
{
    const USE = 'use %s;';

    public function printUse($uses)
    {
        $html = '';

        foreach ($uses as $use) {
            $html .= sprintf(self::USE, $use).PHP_EOL;
        }

        return $html;
    }

    public function getFileDocs($src, $type = null)
    {

        if ($type === null) {
            $type = $src->getType();
        }

        if ($src->getNamespace() === null) {
            $namespace = $this->getModule()->getModuleName().'\\';

            if ($src instanceof Controller) {
                $namespace .= 'Controller';
            } else {
                $namespace .= $src->getType();
            }
        } else {
            $namespace = $this->resolveNamespace($src->getNamespace());
        }

        $namespace = str_replace('\\', '/', $namespace);


        $template = <<<EOS
/**
 * PHP Version 5
 *
 * @category {$type}
 * @package {$namespace}
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */

EOS;

        return $template;
    }


    public function getClassDocsPackage($controller)
    {
        $this->docs = '';

        if (empty($controller->getNamespace())) {
            if ($controller instanceof Controller) {
                $type = 'Controller';
            } else {
                if ($controller->getType() === 'SearchForm') {
                    $type = 'Form/Search';
                } elseif ($controller->getType() === 'ControllerPlugin') {
                    $type = 'Controller/Plugin';
                } elseif ($controller->getType() === 'ViewHelper') {
                    $type = 'View/Helper';
                } else {
                    $type = $controller->getType();
                }
            }

            $this->docs = sprintf('%s/%s', $this->getModule()->getModuleName(), $type);
        } else {
            //$module = $this->getModule()->getModuleName();

            $namespace = $this->resolveNamespace($controller->getNamespace());

            $this->docs = str_replace('\\', '/', $namespace);
        }


        return $this->docs;
    }

    public function getClassDocs($src, $type = null)
    {
        return $this->getFileDocs($src, $type);
    }

    /**
     * Get the Class Location for Save the Class.
     *
     * {@inheritDoc}
     * @see \Gear\Creator\FileLocationInterface::getLocation()
     */
    public function getLocation($data)
    {
        if (!empty($data->getNamespace())) {
            $location = $this->getLocationPath($data);
            return $location;
        }

        $type = $this->str('class', $data->getType());

        if ($data instanceof Controller) {
            return $this->getModule()->map('Controller');
        }

        if ($data instanceof App) {
            $type = 'App'.$type;
        }

        return $this->getModule()->map($type);
    }

    public function getLocationPath($data)
    {
        if ($data instanceof Src || $data instanceof Controller) {
            //$namespace = ($data->getNamespace()[0***REMOVED*** != '\\') ? $this->getModule()->getModuleName().'\\' : '';
            $psr = explode('\\', $data->getNamespace());


            $dirNamespace = implode('/', $psr);

            $this->getDirService()->mkDeepDir($dirNamespace, $this->getModule()->getSrcModuleFolder());

            $location = $this->getModule()->getSrcModuleFolder().'/'.$dirNamespace;

            $this->getDirService()->mkDir($location);

            return $location;
        }

        if ($data instanceof App) {
            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $this->str('var', $item);
            }

            $dirNamespace = implode('/', $psr);

            $this->getDirService()->mkDeepDir($dirNamespace, $this->getModule()->getPublicJsAppFolder());

            $location = $this->getModule()->getPublicJsAppFolder().'/'.$dirNamespace;

            echo $location."\n";
            $this->getDirService()->mkDir($location);
            return $location;
        }
    }

    /**
     * Get the Class Namespace.
     *
     * {@inheritDoc}
     * @see \Gear\Creator\FileNamespaceInterface::getNamespace()
     */
    public function getNamespace($data)
    {
        $class = new ClassObject($data, $this->getModule()->getModuleName());

        return $class->getNamespace();
    }
}
