<?php
namespace Gear\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;

class AclService extends \Gear\Service\AbstractService implements EventManagerAwareInterface
{

    protected $entityManager;
    protected $loadedModules;
    protected $event;


    public function getProjectMetadata()
    {
        $schemas = [***REMOVED***;
        if (count($this->getLoadedModules()) > 0) {
            foreach ($this->getLoadedModules() as $moduleName => $module) {

                if (!method_exists($module, 'getLocation')) {
                    throw new \Exception(
                        sprintf('Module %s has acl active but no has getLocation Method on Module class', $moduleName)
                    );
                }

                $schema = realpath($module->getLocation().'/../../schema/module.json');

                if (!is_file($schema)) {
                    throw new \Exception(sprintf('Module %s has acl activated but has no schema file', $moduleName));
                }

                $schemas[***REMOVED*** = \Zend\Json\Json::decode(file_get_contents($schema));
            }
        }

        return $schemas;

    }

    public function getPages()
    {

        $meta = $this->getProjectMetadata();
        $modules = $this->getLoadedModules();
        $pages = [***REMOVED***;

        foreach ($modules as $moduleName => $module) {

            foreach ($meta as $v) {

                if (isset($v->$moduleName)) {
                    $module = $v->$moduleName;
                    $page = $module->page;
                    foreach ($page as $controller) {
                        $controller = new \Security\ValueObject\Controller($controller);
                        $pages[$moduleName***REMOVED***[***REMOVED*** = $controller;
                    }
                    break;
                }
                continue;
            }
        }

        return $pages;

    }

    public function getEntityManager()
    {
        if (!isset($this->entityManager)) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }

    public function createAclFromPages()
    {
        $meta = $this->getPages();

        foreach ($meta as $modules => $controllers) {

            $moduleEntity = $this->verifyModule($modules);

            foreach ($controllers as $controller) {

                $controllerEntity = $this->verifyController(
                    $moduleEntity,
                    $controller->getName(),
                    $controller->getInvokable()
                );

                foreach ($controller->getAction() as $action) {
                    $actionEntity = $this->verifyAction($controllerEntity, $action->getAction());
                    $roleEntity = $this->verifyRole($action->getRole());
                    $this->verifyRule($controllerEntity, $actionEntity, $roleEntity);
                    continue;
                }
            }
        }
        return true;
    }

    public function loadAcl()
    {
        $this->getEventManager()->trigger('loadModules', $this);
        $this->createAclFromPages();
        return 'loaed' . "\n";
    }


    /**
     * Verify By a Role Exist, if not, create.
     * @param string $roleName
     * @return \Security\Entity\Role $roleEntity
     */
    public function verifyRole($roleName)
    {
        $roleEntity = $this->getEntityManager()->getRepository('Security\Entity\Role')->findOneBy(
            array(
                'idRole' => $roleName
            )
        );

        if ($roleEntity == null) {
            $roleEntity = new \Security\Entity\Role();
            $roleEntity->setRoleId($roleName);
            $roleEntity->setName($roleName);
            $roleEntity->setCreated(new \DateTime('now'));
            $this->getEntityManager()->persist($roleEntity);
            $this->getEntityManager()->flush();
        }
        return $roleEntity;
    }

    /**
     * Verify if a Module Exists on Database
     * If Not, insert
     * @param string $moduleName
     * @return \Security\Entity\Module
     */
    public function verifyModule($moduleName)
    {
        $module = $this->getEntityManager()
        ->getRepository('Security\Entity\Module')
        ->findOneBy(array('name' => $moduleName));

        if (!$module) {
            $module = new \Security\Entity\Module();
            $module->setName($moduleName);
            $module->setCreated(new \DateTime());
            $module->setUpdated(new \DateTime());
            $this->getEntityManager()->persist($module);
            $this->getEntityManager()->flush();
        }
        return $module;
    }

    /**
     * Verify if a Controller Exists on Database
     * If Not, Insert It.
     * @param \Security\Entity\Module $moduleEntity
     * @param string $controllerName
     * @param string $controllerInvokable
     * @return \Security\Entity\Controller
     */
    public function verifyController($moduleEntity, $controllerName, $controllerInvokable)
    {

        $controllerEntity = $this->getEntityManager()
        ->getRepository('Security\Entity\Controller')
        ->findOneBy(
            array(
                'name' => $controllerName,
                'invokable' => sprintf($controllerInvokable, $moduleEntity->getName()),
                'idModule' => $moduleEntity->getIdModule()
            )
        );
        if (!$controllerEntity) {

            $controllerEntity = new \Security\Entity\Controller();
            $controllerEntity->setIdModule($moduleEntity);
            $controllerEntity->setName($controllerName);
            $controllerEntity->setInvokable(sprintf($controllerInvokable, $moduleEntity->getName()));
            $controllerEntity->setCreated(new \DateTime('now'));
            $this->getEntityManager()->persist($controllerEntity);
            $this->getEntityManager()->flush();
        }
        return $controllerEntity;
    }

    public function verifyAction($controllerEntity, $actionName)
    {
        $actionEntity = $this->getEntityManager()
        ->getRepository('Security\Entity\Action')
        ->findOneBy(
            array(
                'name' => $actionName,
                'idController' => $controllerEntity->getIdController()
            )
        );
        if (!$actionEntity) {
            $actionEntity = new \Security\Entity\Action();
            $actionEntity->setIdController($controllerEntity);
            $actionEntity->setName($actionName);
            $actionEntity->setCreated(new \DateTime('now'));
            $this->getEntityManager()->persist($actionEntity);
            $this->getEntityManager()->flush();
        }

        return $actionEntity;
    }

    public function verifyRule($controllerEntity, $actionEntity, $roleEntity)
    {
        $ruleEntity = $this->getEntityManager()
        ->getRepository('Security\Entity\Rule')
        ->findOneBy(
            array(
                'idAction' => $actionEntity->getIdAction(),
                'idController' => $controllerEntity->getIdController(),
                'idRole'       => $roleEntity->getIdRole()
            )
        );

        if (!$ruleEntity) {
            $ruleEntity = new \Security\Entity\Rule();
            $ruleEntity->setIdController($controllerEntity);
            $ruleEntity->setIdAction($actionEntity);
            $ruleEntity->setIdRole($roleEntity);
            $ruleEntity->setCreated(new \DateTime('now'));
            $this->getEntityManager()->persist($ruleEntity);
            $this->getEntityManager()->flush();
        }

        return $ruleEntity;
    }

    public function getLoadedModules()
    {
        return $this->loadedModules;
    }

    public function setLoadedModules($loadedModules)
    {
        $this->loadedModules = $loadedModules;
        return $this;
    }

    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
            __CLASS__,
            get_called_class(),
        ));
        $this->event = $events;
        return $this;
    }

    public function getEventManager()
    {
        if (null === $this->event) {
            $this->setEventManager(new EventManager());
        }
        return $this->event;
    }
}
