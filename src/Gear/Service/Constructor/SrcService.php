<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Zend\Stdlib\Hydrator\ClassMethods;

class SrcService extends AbstractJsonService
{
    protected $srcFactory;

    protected $srcValueObject;

    protected $controllerPluginService;

    protected $filterService;

    protected $formService;

    protected $factoryService;

    protected $repositoryService;

    protected $serviceService;

    protected $valueObjectService;

    protected $entityService;

    protected $configService;

    public function createStdClass()
    {
        $stdClass = new \stdClass;
        $stdClass->name = __CLASS__;
        return new $stdClass;
    }

    public function getConfigService()
    {
        if (!isset($this->configService)) {
            $this->configService = $this->getServiceLocator()->get('configService');
        }
        return $this->configService;
    }

    public function isValid($data)
    {
        return true;
    }

    public function create($data)
    {

        if ($this->isValid($data)) {

            $src = new \Gear\ValueObject\Src($data);

            $schema = $this->getSchema();

            $jsonStatus = $this->getJsonService()->insertController(
                $this->getSchema(), $src->export(), 'src'
            );

            if ($jsonStatus) {

                $configService = $this->getConfigService();
                $configService->mergeServiceManagerConfig();
                $this->factory($src);

                return true;
            }

        }



    }

    public function updateServiceManager()
    {
        $json = \Zend\Json\Json::decode(file_get_contents($this->getJson()));

        $module = &$json->{$this->getConfig()->getModule()};

        if (is_array($module->src)) {

            if (count($module->src)>0) {

                $this->createFileFromTemplate(
                    'template/config/servicemanager',
                    array(
                        'module' => $this->getConfig()->getModule(),
                        'factories' => $module->src
                    ),
                    'servicemanager.config.php',
                    $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
                );

            }
        }
    }


    public function createModuleJson(array $src = array(), $page = array(), $db = array())
    {
        return array(
            $this->getConfig()->getModule() => array(
                'src' => $src,
                'page' => $page,
                'db' => $db
            )
        );
    }

    public static function avaliable()
    {
        return array(
        	'Service',
            'Entity',
            'Repository',
            'Form',
            'Filter',
            'Factory',
            'ValueObject',
            'Controller',
            'Controller\Plugin'
        );

    }

    public function factory($src)
    {

        if ($src->getType() == null) {
            return 'Type not allowed'."\n";
        }

        try {
            switch ($src->getType()) {
                case 'Service':
                    $service = $this->getServiceLocator()->get('serviceService');
                    $status = $service->create($src);
                    break;
                case 'Entity':
                    $entity = $this->getServiceLocator()->get('entityService');
                    $status = $entity->create($src);
                    break;
                case 'Repository':
                    $repository = $this->getServiceLocator()->get('repositoryService');
                    $status = $repository->create($src);
                    break;
                case 'Form':
                    $form = $this->getServiceLocator()->get('formService');
                    $status = $form->create($src);
                    break;
                case 'Filter':
                    $filter = $this->getServiceLocator()->get('filterService');
                    $status = $filter->create($src);
                    break;
                case 'Factory':
                    $factory = $this->getServiceLocator()->get('factoryService');
                    $status = $factory->create($src);
                    break;
                case 'ValueObject':
                    $valueObject = $this->getServiceLocator()->get('valueObjectService');
                    $status = $valueObject->create($src);
                    break;
                case 'Controller':
                    $controller = $this->getServiceLocator()->get('controllerService');
                    $status = $controller->create($src);
                    break;
                case 'Controller\Plugin':
                    $controllerPlugin = $this->getServiceLocator()->get('controllerPluginService');
                    $status = $controllerPlugin->create($src);
                    break;
                default:
                    $status = sprintf('No allowed to create %s', $src->getType())."\n";
                    break;
            }
        } catch (\Exception $exception) {
            throw $exception;
        }

        return true;

    }

    public function setSrcValueObject($srcValueObject)
    {
        $this->srcValueObject = $srcValueObject;

        return $this;
    }

    public function getSrcValueObject()
    {
        if (isset($this->srcValueObject)) {
            return $this->srcValueObject;
        } else {
            return null;
        }
    }

    public function getSrcFactory()
    {
        if (!isset($this->srcFactory)) {
            $this->srcFactory = $this->getServiceLocator()->get('srcFactory');
        }

        return $this->srcFactory;
    }
}
