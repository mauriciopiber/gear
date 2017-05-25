<?php
namespace Gear\Creator\Codes\CodeTest;

use Gear\Creator\Codes\AbstractCodeBase;
use GearJson\Src\Src;
use GearJson\Controller\Controller;
use GearJson\App\App;
use GearJson\Db\Db;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Creator/Codes/CodeTest
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
abstract class AbstractCodeTest extends AbstractCodeBase
{

    public function getTestNamespace($data)
    {
        if (!empty($data->getNamespace())) {
            $namespace = $data->getNamespace();
            return $namespace;
        }

        if ($data instanceof Controller) {
            return 'Controller';
        }

        if ($data->getType() == 'SearchForm') {
            return 'Form\Search';
        }

        if ($data->getType() == 'ControllerPlugin') {
            return 'Controller\Plugin';
        }

        if ($data->getType() == 'ViewHelper') {
            //var_dump($data);
            return 'View\Helper';
        }

        return str_replace('Test', '', $data->getType());
    }

    /**
     * Retorna o nome completo da classe que será utilizada.
     * no formato [Module***REMOVED***\[Namespace***REMOVED***\[Name***REMOVED***
     * Essa função deve ser transferida para abstractCode, serve para retornar todo caminho para uma classe.
     */
    public function getFullClassName($data)
    {
        if (!empty($data->getNamespace())) {
            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $item;
            }

            $implode = implode('\\', $psr);

            $namespace = $implode;
        } else {
            if ($data instanceof Src) {
                if ($data->getType() == 'SearchForm') {
                    $namespace = 'Form\Search';
                } elseif ($data->getType() == 'ViewHelper') {
                    $namespace = 'View\Helper';
                } else {
                    $namespace = $data->getType();
                }
            } else {
                $namespace = 'Controller';
            }
        }

        return $this->getModule()->getModuleName().'\\'.$namespace.'\\'.$data->getName();
    }

    public function getLocationPath($data)
    {
        if ($data instanceof Src || $data instanceof Controller) {
            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $item.'Test';
            }

            $location = $this->getModule()->getTestUnitModuleFolder().'/'.implode('/', $psr);

            $this->getDirService()->mkDeepDir(implode('/', $psr), $this->getModule()->getTestUnitModuleFolder());
            $this->getDirService()->mkDir($location);

            return $location;
        }


        if ($data instanceof App) {
            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $this->str('var', $item).'Spec';
            }

            $location = $this->getModule()->getPublicJsSpecUnitFolder().'/'.implode('/', $psr);

            $this->getDirService()->mkDeepDir(implode('/', $psr), $this->getModule()->getPublicJsSpecUnitFolder());
            $this->getDirService()->mkDir($location);

            echo $location."\n";

            return $location;
        }
    }


    public function getNamespace($data)
    {
        if (!empty($data->getNamespace())) {
            $psr = explode('\\', $data->getNamespace());

            foreach ($psr as $i => $item) {
                $psr[$i***REMOVED*** = $item.'Test';
            }

            $implode = implode('\\', $psr);

            $namespaceFile = $implode;

            return $namespaceFile;
        }

        if ($data instanceof Src) {
            if ($data->getType() == 'SearchForm') {
                return 'FormTest\SearchTest';
            }
            return $data->getType().'Test';
        } else {
            return 'ControllerTest';
        }
    }


    public function getLocation($data)
    {
        if (!empty($data->getNamespace())) {
            $location = $this->getLocationPath($data);
            return $location;
        }

        if ($data instanceof Controller) {
            $type = 'Controller';
        } else {
            $type = $this->str('class', $data->getType());
        }

        if ($data instanceof App) {
            $type = 'App'.$type.'Spec';
        } else {
            $type .= 'Test';
        }

        //var_dump($type);
        //var_dump($this->getModule()->map($type));
        return $this->getModule()->map($type);
    }
}
