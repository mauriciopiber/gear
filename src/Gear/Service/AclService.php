<?php
namespace Gear\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;
use Zend\Crypt\Password\Bcrypt;

class AclService extends \Gear\Service\AbstractService implements EventManagerAwareInterface
{

    protected $entityManager;
    protected $loadedModules;
    protected $event;

    protected $userEntity;


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

                $schemas[***REMOVED*** = \Zend\Json\Json::decode(file_get_contents($schema), 1);
            }
        }

        return $schemas;

    }

    public function getPages()
    {
        $meta = $this->getProjectMetadata();
        $controllers = [***REMOVED***;
        foreach ($meta as $i => $schemaArray) {

            $moduleName = key($schemaArray);
            foreach ($schemaArray[$moduleName***REMOVED***['controller'***REMOVED*** as $controllerArray) {
                $controllers[$moduleName***REMOVED***[***REMOVED*** = new \Gear\ValueObject\Controller($controllerArray);
            }

        }
        return $controllers;
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
                    $controller->getService()->getObject()
                );

                foreach ($controller->getAction() as $action) {
                    $actionEntity = $this->verifyAction($controllerEntity, $action->getName());
                    $roleEntity = $this->verifyRole($action->getRole());
                    $this->verifyRule($controllerEntity, $actionEntity, $roleEntity);
                    continue;
                }
            }
        }
        return true;
    }

    /**
     * Função responsável por garantir que pelo menos admin e guest estarão disponíveis corretamente no sistema à partir da execução do Acl.
     */
    public function insertDefaultRole()
    {
        $roleGuest = new \Security\Entity\Role();
        $roleGuest->setRoleId('guest');
        $roleGuest->setName('guest');
        $roleGuest->setCreated(new \DateTime('now'));
        $roleGuest->setCreatedBy($this->getUserEntity());
        $this->getEntityManager()->persist($roleGuest);
        $this->getEntityManager()->flush();

        $roleAdmin = new \Security\Entity\Role();
        $roleAdmin->setRoleId('admin');
        $roleAdmin->setName('admin');
        $roleAdmin->setIdParent($roleGuest);
        $roleAdmin->setCreated(new \DateTime('now'));
        $roleAdmin->setCreatedBy($this->getUserEntity());
        $this->getEntityManager()->persist($roleAdmin);
        $this->getEntityManager()->flush();

        return true;

    }

    /**
     * Função responsável por garantir que pelo menos um usuário esteja disponíveis pra associar à criação das futuras acls.
     */
    public function insertDefaultUser()
    {
        $userGearCli = new \Security\Entity\User();
        $userGearCli->setEmail('gearcli@pibernetwork.com');
        $bcrypt = new Bcrypt();
        $bcrypt->setCost(14);

        $userGearCli->setPassword($bcrypt->create('gearcli'));
        $userGearCli->setCreated(new \DateTime('now'));
        $userGearCli->setState(1);

        $userGearCli->setUsername('');
        $userGearCli->setUid(uniqid(true, true));

        $this->getEntityManager()->persist($userGearCli);
        $this->getEntityManager()->flush();

        $userGearCli->setCreatedBy($userGearCli);
        $userGearCli->setUpdated(new \DateTime('now'));
        $userGearCli->setUpdatedBy($userGearCli);

        $this->getEntityManager()->persist($userGearCli);
        $this->getEntityManager()->flush();

        $this->setUserEntity($userGearCli);

        return $userGearCli;
    }

    public function insertUserRoleLinker()
    {
        $connection = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getConnection();
        $sql = sprintf('INSERT INTO user_role_linker (id_role,id_user) VALUES ("admin",%s)', $this->getUserEntity()->getId());
        $connection->query($sql);
    }

    public function setUpAcl($data = array())
    {

        if (isset($data['reset'***REMOVED***) && true === $data['reset'***REMOVED***) {
            $this->dropAcl();
        }

        $this->getEventManager()->trigger('loadModules', $this);

        if (isset($data['user'***REMOVED***) && true === $data['user'***REMOVED***) {
            $this->insertDefaultUser();
        } else {

            $this->setUserEntity($this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getRepository('Security\Entity\User')->findOneBy(array('email' => 'mauriciopiber@gmail.com')));
        }

        if (isset($data['role'***REMOVED***) && true === $data['role'***REMOVED***) {
            $this->insertDefaultRole();
            $this->insertUserRoleLinker();
        }

        $this->createAclFromPages($this->getUserEntity());
        return true;
    }

    public function dropAcl()
    {

        $this->truncate('Security\Entity\Module');

        $rules = $this->getEntityManager()->getRepository('Security\Entity\Rule')->findAll();

        if (count($rules)>0) {
            foreach ($rules as $rule) {
                $this->getEntityManager()->remove($rule);
            }
        }

        $actions = $this->getEntityManager()->getRepository('Security\Entity\Action')->findAll();

        if (count($actions)>0) {
            foreach ($actions as $action) {
                $this->getEntityManager()->remove($action);
            }
        }

        $controllers = $this->getEntityManager()->getRepository('Security\Entity\Controller')->findAll();

        if (count($controllers)>0) {
            foreach ($controllers as $controller) {
                $this->getEntityManager()->remove($controller);
            }
        }

        $this->truncate('Security\Entity\Role');
        $this->truncate('Security\Entity\User');

        $this->getEntityManager()->flush();



    }

    public function truncate($entity)
    {
        $entities = $this->getEntityManager()->getRepository($entity)->findAll();

        if (count($entities)>0) {
            foreach ($entities as $entity) {
                $this->getEntityManager()->remove($entity);
            }
        }
        return true;
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
            $roleEntity->setCreatedBy($this->getUserEntity());
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
            $module->setCreatedBy($this->getUserEntity());
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
            $controllerEntity->setCreatedBy($this->getUserEntity());
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
            $actionEntity->setCreatedBy($this->getUserEntity());
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
            $ruleEntity->setCreatedBy($this->getUserEntity());
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

	public function getUserEntity()
	{
		return $this->userEntity;
	}

	public function setUserEntity($userEntity)
	{
		$this->userEntity = $userEntity;
		return $this;
	}

}
